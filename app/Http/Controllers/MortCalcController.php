<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Gbrock\Table\Facades\Table; # Refernce: Used Table from gbrock git lib https://github.com/gbrock/laravel-table
use App\Scenario; # to use the Scenario Model;
use App\Property; # to use the Property Model;
use App\Feature; # to use the Feature Model;
use App\FeatureProperty; # to use the FeatureProperty Model;
use Session; # to use alert and confirmation messages;

class MortCalcController extends Controller
{
  # main view function - landing page / default for reset
  public function index() {
        return view('index');
  } #end of index Method

  # readme view function
  public function readme() {
        return view('readme');
  } #end of readme Method

  # request processing function with validaiton and logic code
  public function process (Request $request) {

        #access the request using this and apply laravel validation rules on inputs
        $this->validate($request,[
          'loan' => 'required|numeric|min:1|max:100000000',
          'interestRate' => 'required|numeric|min:1|max:25',
          'interestType' => 'required|present',
          'loanDuration' => 'required|not_in:0|min:1|max:30'
        ]);

        # get loan data from the form using request and format/calculate for display
        $loan=$request->input('loan', null);
        $interestRate=$request->input('interestRate', null);
        $interestRateMonthly = $interestRate/12;
        $interestType=$request->Input('interestType');
        $loanDuration=$request->input('loanDuration');
        $loanMonths=$loanDuration*12;

        # Logic: Formulae & Calculations used to determine mortage payments
        if($interestRate>0 && $loanDuration>0 && $loan>0) {
            $monthlyPayment = $loan*(($interestRate/100/12)*Pow((1+($interestRate/100/12)),$loanMonths))/(Pow((1+($interestRate/100/12)),$loanMonths)-1);
            # Reference: Learned and leveraged arithematic functions used at this website: http://php.net/manual/en/language.operators.arithmetic.php
            # Reference: Obatined Mortage Loan Payment formualae from this website: https://www.mtgprofessor.com/formulas.htm
            # Mortage Payment Formula: P = L[c(1 + c)^n]/[(1 + c)^n - 1]
        		# Where: L = Loan amount, c=monthly interest rate=Annual Interest Rate/12, P = Monthly payment, n = Month when the balance is paid in full, B = Remaining Balance
        	}
        else {
            $monthlyPayment=0;
          }

        # variable declaration and calculations for the display file
        $loanTbl = $loan;
        $monthlyPaymentTbl = $monthlyPayment;
        $interestTotal=0;
        $interestRateAvg=0;

        # amortization table array initalization
        $array_pmtNo=[];
        $array_loan=[];
        $array_interestRateMonthly=[];
        $array_monthlyPayment=[];
        $array_interest=[];
        $array_principal=[];
        $array_loanBalance=[];
        $array_date=[];

        # loop to load up arrays for amortization table
      for($i = 1; $i<=$loanMonths; $i++)
      {
        # if interest type is fixed, keep interest rate fixed, or else randomly fluctuate between +-1% of entered annual interest rate
        if($interestType=='fixed'){
            $interestRateMonthlyTbl=$interestRateMonthly;
        }
        else {
            $interestRateMonthlyTbl=((rand($interestRate*100+100,$interestRate*100-100))/100/12);
        }
        # loading up arrays using loop variables
        $array_pmtNo[$i]=$i;
        $array_loan[$i]=$loanTbl;
        $array_interestRateMonthly[$i]=Round($interestRateMonthlyTbl,3);
        $array_monthlyPayment[$i]=Round($monthlyPaymentTbl,2);
        $array_interest[$i]=Round(($loanTbl*$interestRateMonthlyTbl/100),2);
        $array_principal[$i]=Round(($monthlyPaymentTbl-($loanTbl*$interestRateMonthlyTbl/100)),2);
        $array_loanBalance[$i]=$loanTbl=Round(($loanTbl-($monthlyPaymentTbl-($loanTbl*$interestRateMonthlyTbl/100))),2);
        $array_interestCumulative[$i]=$array_interest[$i]=Round(($loanTbl*$interestRateMonthlyTbl/100),2);
        # loan total lifetime cost calculations within loop
        $interestTotal=$interestTotal+Round(($loanTbl*$interestRateMonthlyTbl/100),2);
        $interestRateAvg=$interestRateAvg+$interestRateMonthlyTbl;
        $array_date[$i] = date("M-Y", strtotime("+$i month"));
      }
        # loan total lifetime cost calculations after loop
        $interestRateAvg=$interestRateAvg/$loanMonths;
        $loanTotalCost=$interestTotal+$loan;
        #Reference 1: Formula for Monthly interest calculations: http://homeguides.sfgate.com/calculate-principal-interest-mortgage-2409.html
        #Reference 2: Learned and leveraged this site to understand syntax for number format function. http://php.net/manual/en/function.number-format.php
        #Reference 3: Learned how to access array in Laravel. http://stackoverflow.com/questions/36050266/laravel-accessing-array-data-in-view
        #Reference 4: Learned how to pass array from controller to view in Laravel. http://stackoverflow.com/questions/26251108/form-passing-array-from-controller-to-view-php-laravel

    # return of values back to the view
    return view('index')->with([
        'loanDisplay'=>number_format($loan, 2, '.', ','),
        'interestRateDisplay'=>$interestRate,
        'interestRateMonthlyDisplay'=>Round($interestRateMonthly,3),
        'interestTypeDisplay'=>$interestType,
        'loanDurationDisplay'=>$loanDuration,
        'loanMonths'=>$loanMonths,
        'monthlyPaymentDisplay'=>number_format($monthlyPayment, 2, '.', ','),
        'loanTbl'=>$loanTbl,
        'monthlyPaymentTbl'=>$monthlyPaymentTbl,
        'array_pmtNo'=>$array_pmtNo,
        'array_loan'=>$array_loan,
        'array_interestRateMonthly'=>$array_interestRateMonthly,
        'array_monthlyPayment'=>$array_monthlyPayment,
        'array_interest'=>$array_interest,
        'array_principal'=>$array_principal,
        'array_loanBalance'=>$array_loanBalance,
        'interestTotal'=>number_format($interestTotal, 2, '.', ','),
        'interestRateAvg'=>Round($interestRateAvg, 3),
        'loanTotalCost'=>number_format($loanTotalCost, 2, '.', ','),
        'array_date'=>$array_date
    ]);

  } #end of process Method

  public function scenarioMenu() {
    return view('scenario');
  } #end of scenarioMenu Method


  public function addScenario(Request $request) {
    # retrieving property model info to link Scenario with Property
    $properties = Property::all();

    return view('scenario.save')->with([
          'properties' => $properties,
    ]);
  } #end of addScenario Method

  public function saveScenario(Request $request) {

        # retrieving property model info to link Scenario with Property
        $properties = Property::all();

        # access the request using this and apply laravel validation rules on inputs
        $this->validate($request,[
          'scenarioNumber' => 'required|numeric|min:1|max:100000000',
          'scenarioName' => 'required|alpha_num',
          'loan' => 'required|numeric|min:1|max:100000000',
          'interestRate' => 'required|numeric|min:1|max:25',
          'interestType' => 'required|present',
          'loanDuration' => 'required|not_in:0|min:1|max:30',
          'property'=> 'required|not_in:0',
        ]);

        # get loan data from the form using request and format/calculate for display
        $scenarioNumber = $request->input('scenarioNumber');
        $scenarioName = $request->input('scenarioName');
        $loan = $request->input('loan', null);
        $interestRate = $request->input('interestRate', null);
        $interestRateMonthly = $interestRate/12;
        $interestType = $request->Input('interestType');
        $loanDuration = $request->input('loanDuration');
        $loanMonths = $loanDuration*12;
        $propertyId = $request->input('property');

        # Logic: Formulae & Calculations used to determine mortage payments
        if($interestRate>0 && $loanDuration>0 && $loan>0) {
            $monthlyPayment = $loan*(($interestRate/100/12)*Pow((1+($interestRate/100/12)),$loanMonths))/(Pow((1+($interestRate/100/12)),$loanMonths)-1);
            # Reference: Learned and leveraged arithematic functions used at this website: http://php.net/manual/en/language.operators.arithmetic.php
            # Reference: Obatined Mortage Loan Payment formualae from this website: https://www.mtgprofessor.com/formulas.htm
            # Mortage Payment Formula: P = L[c(1 + c)^n]/[(1 + c)^n - 1]
        		# Where: L = Loan amount, c=monthly interest rate=Annual Interest Rate/12, P = Monthly payment, n = Month when the balance is paid in full, B = Remaining Balance
        	}
        else {
            $monthlyPayment=0;
          }

        # variable declaration and calculations for the display file
        $loanTbl = $loan;
        $monthlyPaymentTbl = $monthlyPayment;
        $interestTotal=0;
        $interestRateAvg=0;

        # amortization table array initalization
        $array_pmtNo=[];
        $array_loan=[];
        $array_interestRateMonthly=[];
        $array_monthlyPayment=[];
        $array_interest=[];
        $array_principal=[];
        $array_loanBalance=[];
        $array_date=[];

        # loop to load up arrays for amortization table
      for($i = 1; $i<=$loanMonths; $i++)
      {
        # if interest type is fixed, keep interest rate fixed, or else randomly fluctuate between +-1% of entered annual interest rate
        if($interestType=='fixed'){
            $interestRateMonthlyTbl=$interestRateMonthly;
        }
        else {
            $interestRateMonthlyTbl=((rand($interestRate*100+100,$interestRate*100-100))/100/12);
        }
        # loading up arrays using loop variables
        $array_pmtNo[$i]=$i;
        $array_loan[$i]=$loanTbl;
        $array_interestRateMonthly[$i]=Round($interestRateMonthlyTbl,3);
        $array_monthlyPayment[$i]=Round($monthlyPaymentTbl,2);
        $array_interest[$i]=Round(($loanTbl*$interestRateMonthlyTbl/100),2);
        $array_principal[$i]=Round(($monthlyPaymentTbl-($loanTbl*$interestRateMonthlyTbl/100)),2);
        $array_loanBalance[$i]=$loanTbl=Round(($loanTbl-($monthlyPaymentTbl-($loanTbl*$interestRateMonthlyTbl/100))),2);
        $array_interestCumulative[$i]=$array_interest[$i]=Round(($loanTbl*$interestRateMonthlyTbl/100),2);
        # loan total lifetime cost calculations within loop
        $interestTotal=$interestTotal+Round(($loanTbl*$interestRateMonthlyTbl/100),2);
        $interestRateAvg=$interestRateAvg+$interestRateMonthlyTbl;
        $array_date[$i] = date("M-Y", strtotime("+$i month"));
      }
        # loan total lifetime cost calculations after loop
        $interestRateAvg=$interestRateAvg/$loanMonths;
        $loanTotalCost=$interestTotal+$loan;
        #Reference 1: Formula for Monthly interest calculations: http://homeguides.sfgate.com/calculate-principal-interest-mortgage-2409.html
        #Reference 2: Learned and leveraged this site to understand syntax for number format function. http://php.net/manual/en/function.number-format.php
        #Reference 3: Learned how to access array in Laravel. http://stackoverflow.com/questions/36050266/laravel-accessing-array-data-in-view
        #Reference 4: Learned how to pass array from controller to view in Laravel. http://stackoverflow.com/questions/26251108/form-passing-array-from-controller-to-view-php-laravel


        # Save scenario to the database
        $scenario = new Scenario();
        $scenario->scenario_number = $scenarioNumber;
        $scenario->scenario_name = $scenarioName;
        $scenario->loan_amount = $loan;
        $scenario->interest_rate_annual = $interestRate;
        $scenario->interest_rate_monthly = $interestRateMonthly;
        $scenario->interest_type = $interestType;
        $scenario->loan_duration_years = $loanDuration;
        $scenario->loan_duration_months = $loanMonths;
        $scenario->loan_monthly_payment = $monthlyPayment;
        $scenario->interest_total_paid = $interestTotal;
        $scenario->interest_rate_average = $interestRateAvg;
        $scenario->loan_total_cost = $loanTotalCost;
        $scenario->loan_payments_count = $loanMonths;
        $scenario->property_id = $propertyId;

        $scenario->save();
        Session::flash('message', 'Confirmation Message: The mortgage loan scenario '.$request->scenarioName.' was saved in the database.');

    # return of values back to the view
    return view('scenario.save')->with([
        'scenarioNumber' => $scenarioNumber,
        'scenarioName' => $scenarioName,
        'loanDisplay'=>number_format($loan, 2, '.', ','),
        'interestRateDisplay'=>$interestRate,
        'interestRateMonthlyDisplay'=>Round($interestRateMonthly,3),
        'interestTypeDisplay'=>$interestType,
        'loanDurationDisplay'=>$loanDuration,
        'loanMonths'=>$loanMonths,
        'monthlyPaymentDisplay'=>number_format($monthlyPayment, 2, '.', ','),
        'loanTbl'=>$loanTbl,
        'monthlyPaymentTbl'=>$monthlyPaymentTbl,
        'array_pmtNo'=>$array_pmtNo,
        'array_loan'=>$array_loan,
        'array_interestRateMonthly'=>$array_interestRateMonthly,
        'array_monthlyPayment'=>$array_monthlyPayment,
        'array_interest'=>$array_interest,
        'array_principal'=>$array_principal,
        'array_loanBalance'=>$array_loanBalance,
        'interestTotal'=>number_format($interestTotal, 2, '.', ','),
        'interestRateAvg'=>Round($interestRateAvg, 3),
        'loanTotalCost'=>number_format($loanTotalCost, 2, '.', ','),
        'array_date'=>$array_date,
        'property' => $propertyId,
        'properties' => $properties,
      ]);
  } #end of saveScenario Method


  public function viewAllScenario() {
      # retrieving scenario model info
      $scenarios = Scenario::all();
      # using laravel package gbrock for table display
      $table = Table::create($scenarios);
      return view('scenario.viewAll', ['table' => $table]);

  } #end of viewAllScenario Method

  public function viewScenario($id) {

    # First get a scenario to view
    $scenario = Scenario::find($id);
    # If scenatio does not exist in the database, redirect to view all
    if(!$scenario) {
        dump('Alert Message: Mortgage Loan Scenario not found in the database, cannot show/view.');
        return redirect('scenario/view');
    }
    else {

      $propertySelect = $scenario->property_id;
      $properties = Property::where('id',$propertySelect)->get();
      $property = $properties->whereIn('id',$propertySelect);
      $featureProperties = FeatureProperty::where('property_id',$propertySelect)->get();
      # Declare features of array and use it in filtering the query
      $array_feature=[];
      foreach ($featureProperties as $featureProperty) {
          $array_feature[]=$featureProperty->feature_id;
      }
      $features = Feature::whereIn('id',$array_feature)->get();
      # Leveraged idea from here: http://stackoverflow.com/questions/17605693/laravel-4-eloquent-orm-select-where-array-as-parameter

            # get data from the saved scenario and format/calculate for display
            $scenarioNumber = $scenario->scenario_number;
            $scenarioName = $scenario->scenario_name;
            $loan = $scenario->loan_amount;
            $interestRate = $scenario->interest_rate_annual;
            $interestRateMonthly = $scenario->interest_rate_monthly;
            $interestType = $scenario->interest_type;
            $loanDuration = $scenario->loan_duration_years;
            $loanMonths = $scenario->loan_duration_months;
            $monthlyPayment = $scenario->loan_monthly_payment;
            $interestTotal = $scenario->interest_total_paid;

            $interestRateAvg = $scenario->interest_rate_average;
            $loanTotalCost = $scenario->loan_total_cost;
            $loanMonths = $scenario->loan_payments_count;

            # variable declaration and calculations for the display file
            $loanTbl = $loan;
            $monthlyPaymentTbl = $monthlyPayment;
            $interestTotal=0;
            $interestRateAvg=0;

            # amortization table array initalization
            $array_pmtNo=[];
            $array_loan=[];
            $array_interestRateMonthly=[];
            $array_monthlyPayment=[];
            $array_interest=[];
            $array_principal=[];
            $array_loanBalance=[];
            $array_date=[];

            # loop to load up arrays for amortization table
          for($i = 1; $i<=$loanMonths; $i++)
          {
            # if interest type is fixed, keep interest rate fixed, or else randomly fluctuate between +-1% of entered annual interest rate
            if($interestType=='fixed'){
                $interestRateMonthlyTbl=$interestRateMonthly;
            }
            else {
                $interestRateMonthlyTbl=((rand($interestRate*100+100,$interestRate*100-100))/100/12);
            }
            # loading up arrays using loop variables
            $array_pmtNo[$i]=$i;
            $array_loan[$i]=$loanTbl;
            $array_interestRateMonthly[$i]=Round($interestRateMonthlyTbl,3);
            $array_monthlyPayment[$i]=Round($monthlyPaymentTbl,2);
            $array_interest[$i]=Round(($loanTbl*$interestRateMonthlyTbl/100),2);
            $array_principal[$i]=Round(($monthlyPaymentTbl-($loanTbl*$interestRateMonthlyTbl/100)),2);
            $array_loanBalance[$i]=$loanTbl=Round(($loanTbl-($monthlyPaymentTbl-($loanTbl*$interestRateMonthlyTbl/100))),2);
            $array_interestCumulative[$i]=$array_interest[$i]=Round(($loanTbl*$interestRateMonthlyTbl/100),2);
            $array_date[$i] = date("M-Y", strtotime("+$i month"));
            }
            $salePrice = $property[0]->sale_price;
            $downPayment = $salePrice - $loan;

            if($downPayment>0) {
               $downPayment =  round($downPayment,2);
             }
            else {
               $downPayment = 0;
            }
            $estimatedClosingCost = Round($loan * 0.02,2);

        return view('scenario.view')->with([
                 'id'=> $id,
                'scenario' => $scenario,
                'properties' => $properties,
                'features' => $features,
                'scenarioNumber' => $scenarioNumber,
                'scenarioName' => $scenarioName,
                'loanDisplay'=>number_format($loan, 2, '.', ','),
                'interestRateDisplay'=>$interestRate,
                'interestRateMonthlyDisplay'=>Round($interestRateMonthly,3),
                'interestTypeDisplay'=>$interestType,
                'loanDurationDisplay'=>$loanDuration,
                'loanMonths'=>$loanMonths,
                'monthlyPaymentDisplay'=>number_format($monthlyPayment, 2, '.', ','),
                'loanTbl'=>$loanTbl,
                'monthlyPaymentTbl'=>$monthlyPaymentTbl,
                'array_pmtNo'=>$array_pmtNo,
                'array_loan'=>$array_loan,
                'array_interestRateMonthly'=>$array_interestRateMonthly,
                'array_monthlyPayment'=>$array_monthlyPayment,
                'array_interest'=>$array_interest,
                'array_principal'=>$array_principal,
                'array_loanBalance'=>$array_loanBalance,
                'interestTotal'=>number_format($interestTotal, 2, '.', ','),
                'interestRateAvg'=>Round($interestRateAvg, 3),
                'loanTotalCost'=>number_format($loanTotalCost, 2, '.', ','),
                'array_date'=>$array_date,
                'downPayment' => $downPayment,
                'estimatedClosingCost' => $estimatedClosingCost,
              ]);

        }
  } #end of viewScenario method


  public function searchScenario(Request $request) {
         # Leveraged lecture example to create this method
         # access the request using this and apply laravel validation rules on inputs
        //  $this->validate($request,[
        //    'searchText' => 'required|alpha_num'
        //  ]);
        # Store the searchText in a variable and initialize count variable
        $searchText = $request->input('searchText', null);
        $resultCount='';
        # Only try and search *if* there's a searchTerm
        if($searchText) {
            # if search term exists
            if($request->has('similarSearch')) {
                # search by wild card search
                $scenarios = Scenario::where('scenario_name', 'LIKE', '%'.$searchText.'%')->get();
                $resultCount = Scenario::where('scenario_name', 'LIKE', '%'.$searchText.'%')->get()->count();
                # Reference: Technique used for wild card search. http://stackoverflow.com/questions/30761950/laravel-5-like-equivalent-eloquent
            }
            else {
                # search by equal text compare
                $scenarios = Scenario::where('scenario_name', 'LIKE', $searchText)->get();
                $resultCount = Scenario::where('scenario_name', 'LIKE', $searchText)->get()->count();
            }
            # gbrock laravel table package, populate table with searched array
            $table = Table::create($scenarios);
            # Return view with searched scenario in a table along with relavent info
            return view('scenario.search', ['table' => $table])->with([
                 'searchText' => $searchText,
                 'resultCount' => $resultCount
             ]);

      }
      else {
          return view('scenario.search');
      }

  } #end of searchScenario method


  public function loadScenario() {
        $scenario = Scenario::All();

        $id = $scenario->pluck('id');
        return view('scenario.load')->with([
            'id' => $id,
            'scenario' => $scenario
        ]);

  } #end of loadScenario method


  public function selectScenario($id) {
        $scenario = Scenario::find($id);
        $properties = Property::All();
         if(!$scenario) {
             dump('Alert Message: Mortgage Loan Scenario not found in the database.');
             return redirect('scenario/change');
         }
        return view('scenario.update')->with([
            'id'=> $id,
           'scenario' => $scenario,
           'properties' => $properties,
        ]);
  } #end of selectScenario method

  public function updateScenario(Request $request) {

    # Find a scenario to update from database and load into the model.
    $scenario = Scenario::find($request->id);
    $properties = Property::all();

    if(!$scenario) {
        dump('Alert Message: Mortgage Loan Scenario not found in the database.');
        return redirect('scenario/change');
    }
    else {

                    #access the request using this and apply laravel validation rules on inputs
                    $this->validate($request,[
                      'scenarioNumber' => 'required|numeric|min:1|max:100000000',
                      'scenarioName' => 'required|alpha_num',
                      'loan' => 'required|numeric|min:1|max:100000000',
                      'interestRateAnnual' => 'required|numeric|min:1|max:25',
                      'interestType' => 'required|present',
                      'loanDurationYears' => 'required|not_in:0|min:1|max:30',
                      'property'=> 'required|not_in:0'
                    ]);

                    # get loan data from the form using request and format/calculate for display
                    $scenarioNumber = $request->scenarioNumber;;
                    $scenarioName = $request->scenarioName;
                    $loan = $request->loan;
                    $interestRate = $request->interestRateAnnual;
                    $interestRateMonthly = $request->interestRateAnnual/12;
                    $interestType = $request->interestType;
                    $loanDuration = $request->loanDurationYears;
                    $loanMonths = $loanDuration*12;
                    $property = $request->property;

                    # Logic: Formulae & Calculations used to determine mortage payments
                    if($interestRate>0 && $loanDuration>0 && $loan>0) {
                        $monthlyPayment = $loan*(($interestRate/100/12)*Pow((1+($interestRate/100/12)),$loanMonths))/(Pow((1+($interestRate/100/12)),$loanMonths)-1);
                        # Reference: Learned and leveraged arithematic functions used at this website: http://php.net/manual/en/language.operators.arithmetic.php
                        # Reference: Obatined Mortage Loan Payment formualae from this website: https://www.mtgprofessor.com/formulas.htm
                        # Mortage Payment Formula: P = L[c(1 + c)^n]/[(1 + c)^n - 1]
                    		# Where: L = Loan amount, c=monthly interest rate=Annual Interest Rate/12, P = Monthly payment, n = Month when the balance is paid in full, B = Remaining Balance
                    	}
                    else {
                        $monthlyPayment=0;
                      }

                    # variable declaration and calculations for the display file
                    $loanTbl = $loan;
                    $monthlyPaymentTbl = $monthlyPayment;
                    $interestTotal=0;
                    $interestRateAvg=0;

                    # amortization table array initalization
                    $array_pmtNo=[];
                    $array_loan=[];
                    $array_interestRateMonthly=[];
                    $array_monthlyPayment=[];
                    $array_interest=[];
                    $array_principal=[];
                    $array_loanBalance=[];
                    $array_date=[];

                    # loop to load up arrays for amortization table
                  for($i = 1; $i<=$loanMonths; $i++)
                  {
                    # if interest type is fixed, keep interest rate fixed, or else randomly fluctuate between +-1% of entered annual interest rate
                    if($interestType=='fixed'){
                        $interestRateMonthlyTbl=$interestRateMonthly;
                    }
                    else {
                        $interestRateMonthlyTbl=((rand($interestRate*100+100,$interestRate*100-100))/100/12);
                    }
                    # loading up arrays using loop variables
                    $array_pmtNo[$i]=$i;
                    $array_loan[$i]=$loanTbl;
                    $array_interestRateMonthly[$i]=Round($interestRateMonthlyTbl,3);
                    $array_monthlyPayment[$i]=Round($monthlyPaymentTbl,2);
                    $array_interest[$i]=Round(($loanTbl*$interestRateMonthlyTbl/100),2);
                    $array_principal[$i]=Round(($monthlyPaymentTbl-($loanTbl*$interestRateMonthlyTbl/100)),2);
                    $array_loanBalance[$i]=$loanTbl=Round(($loanTbl-($monthlyPaymentTbl-($loanTbl*$interestRateMonthlyTbl/100))),2);
                    $array_interestCumulative[$i]=$array_interest[$i]=Round(($loanTbl*$interestRateMonthlyTbl/100),2);
                    # loan total lifetime cost calculations within loop
                    $interestTotal=$interestTotal+Round(($loanTbl*$interestRateMonthlyTbl/100),2);
                    $interestRateAvg=$interestRateAvg+$interestRateMonthlyTbl;
                    $array_date[$i] = date("M-Y", strtotime("+$i month"));
                  }
                    # loan total lifetime cost calculations after loop

                    $interestRateAvg=$interestRateAvg/$loanMonths;
                    $loanTotalCost=$interestTotal+$loan;
                    #Reference 1: Formula for Monthly interest calculations: http://homeguides.sfgate.com/calculate-principal-interest-mortgage-2409.html
                    #Reference 2: Learned and leveraged this site to understand syntax for number format function. http://php.net/manual/en/function.number-format.php
                    #Reference 3: Learned how to access array in Laravel. http://stackoverflow.com/questions/36050266/laravel-accessing-array-data-in-view
                    #Reference 4: Learned how to pass array from controller to view in Laravel. http://stackoverflow.com/questions/26251108/form-passing-array-from-controller-to-view-php-laravel


                    #Save scenario to the database
                    $scenario->scenario_number = $scenarioNumber;
                    $scenario->scenario_name = $scenarioName;
                    $scenario->loan_amount = $loan;
                    $scenario->interest_rate_annual = $interestRate;
                    $scenario->interest_rate_monthly = $interestRateMonthly;
                    $scenario->interest_type = $interestType;
                    $scenario->loan_duration_years = $loanDuration;
                    $scenario->loan_duration_months = $loanMonths;
                    $scenario->loan_monthly_payment = $monthlyPayment;
                    $scenario->interest_total_paid = $interestTotal;
                    $scenario->interest_rate_average = $interestRateAvg;
                    $scenario->loan_total_cost = $loanTotalCost;
                    $scenario->loan_payments_count = $loanMonths;
                    $scenario->property_id = $property;

                    # Save the changes
                    $scenario->save();
                    Session::flash('message', 'Confirmation Message: Mortgage Loan Scenario updated to the database.');

        return redirect('/scenario/update/'.$request->id);

    }
  } #end of updateScenario method

  # leverage & enhanced removal method from class notes
  public function stageRemoval($id) {
      # Get the scenario they're attempting to delete
      $scenario = Scenario::find($id);
      if(!$scenario) {
          dump('Alert Message: Mortgage Loan Scenario not found in the database.');
          return redirect('scenario/delete');
      }
          return view('scenario.remove')->with('scenario', $scenario);
  } #end of stageRemoval method

  public function removeScenario(Request $request) {
      # leverage code from class notes http://dwa15.com
      # First get a scenario to delete using model retrieval
      $scenario = Scenario::find($request->id);
      # if scenario is not found, error messsage, else confirm removal
      if(!$scenario) {
          dump('Alert Message: Mortgage Loan Scenario not found in the database');
          return redirect('scenario/delete');
      }
      else {
          $scenario->delete();
          Session::flash('message', 'Confirmation Message: Mortgage Loan Scenario was successfully removed from the database.');
          return redirect('/scenario/delete');
      }
  } #end of removeScenario method





  public function propertyMenu() {
          return view('property');
  } #end of propertyMenu method



  public function loadProperty() {
      # retrieve model
      $properties = Property::All();
      # extract property id using pluck method
      $id = $properties->pluck('id');
      # return view with property and its it
      return view('property.load')->with([
          'id' => $id,
          'properties' => $properties
      ]);

  } #end of loadProperty method


  public function viewAllProperty() {
      # retrieve model
      $properties = Property::all();
      # build table using custom package gbrock
      $table = Table::create($properties);
      # return view with table show all prorperty listings
      return view('property.viewAll', ['table' => $table]);
  } #end of viewAllProperty method


  public function viewProperty($id) {
      # retrieve models
      $properties = Property::where('id',$id)->first();
      $featureProperties = FeatureProperty::where('property_id', $id)->get();
      # initalize blank array, use foreach loop to load up by iterating through $featuerProperties
      $array_feature=[];
      foreach ($featureProperties as $featureProperty) {
          $array_feature[]=$featureProperty->feature_id;
      }
      # retrieve features using the above loaded array
      $features = Feature::whereIn('id',$array_feature)->get();
      # Reference: Leveraged idea from here: http://stackoverflow.com/questions/17605693/laravel-4-eloquent-orm-select-where-array-as-parameter
      # if properties not found, alert message
      if(!$properties) {
          dump('Alert Message: Property Listing not found in the database, cannot show/view.');
          return redirect('property/view');
      }
      else {
      # return view with properties and features data from the models
      return view('property.view')->with([
               'id'=> $id,
              'properties' => $properties,
              'features' => $features,
           ]);
      }
  } #end of viewProperty method




  public function addProperty(Request $request) {
      # retrieve model
      $features = Feature::all();
      # return view with features from the model
      return view('property.save')->with([
            'features' => $features,
      ]);
  } #end of addProperty method

  public function saveProperty(Request $request) {
        # retrie model
        $features = Feature::all();

        #access the request using this and apply laravel validation rules on inputs
        $this->validate($request,[
          'propertyNumber' => 'required|numeric|min:1|max:1000000',
          'propertyName' => 'required',
          'propertyAddress' => 'required',
          'propertyType' => 'required',
          'propertySizeBd' => 'required|numeric|min:1|max:9',
          'propertySizeBd' => 'required|numeric|min:1|max:9',
          'propertySizeBd' => 'required|numeric|min:1|max:9',
          'livingArea' => 'required|numeric|min:1|max:10000',
          'lotSize' => 'required|numeric|min:0.01|max:10000',
          'yearBuilt' => 'required|numeric|min:1000|max:2017',
          'salePrice' => 'required|numeric|min:1|max:100000000',
          'taxRate' => 'required|numeric|min:0|max:10',
          'hoaYearly' => 'required|numeric|min:1|max:10000'
        ]);

        # get loan data from the form using request and format/calculate for display
        $propertyNumber = $request->input('propertyNumber');
        $propertyName = $request->input('propertyName');
        $propertyAddress = $request->input('propertyAddress');
        $propertyType = $request->input('propertyType');
        $propertySizeBd = $request->input('propertySizeBd');
        $propertySizeBa = $request->input('propertySizeBa');
        $propertySizeGa = $request->input('propertySizeGa');
        $livingArea = $request->Input('livingArea');
        $lotSize = $request->input('lotSize');
        $yearBuilt = $request->input('yearBuilt');
        $salePrice = $request->input('salePrice');
        $taxRate = $request->input('taxRate');
        $hoaYearly = $request->input('hoaYearly');
        $propertySize = $propertySizeBd.'bd-'.$propertySizeBa.'ba-'.$propertySizeGa.'ga';

        #Save scenario to the database
        $properties = new Property();
        $properties->property_number = $propertyNumber;
        $properties->property_name = $propertyName;
        $properties->property_address = $propertyAddress;
        $properties->property_type = $propertyType;
        $properties->property_size = $propertySize;
        $properties->living_area = $livingArea;
        $properties->lot_size = $lotSize;
        $properties->year_built = $yearBuilt;
        $properties->sale_price = $salePrice;
        $properties->tax_rate = $taxRate;
        $properties->hoa_yearly = $hoaYearly;
        $properties->save();
        #confirmation session message
        Session::flash('message', 'Confirmation Message: The real estate property information was saved to the database successfully.');

    # return of properties data back to the view
    return view('property.save')->with([
          'properties' => $properties,
      ]);
  }



  public function selectProperty($id) {
      # retrieve models
      $properties = Property::find($id);
      $features = Feature::All();

      if(!$properties) {
        dump('Alert Message: The real estate property information not found in the database.');
        return redirect('property/change');
      }
      # return view with data from properties and features models
        return view('property.update')->with([
            'id'=> $id,
           'features' => $features,
           'properties' => $properties,
        ]);

  } #end of selectProperty method

  public function updateProperty(Request $request) {
        # retirve models and find a property to update
        $properties = Property::find($request->id);
        $features = Feature::all();
        # condtional if property is not found
        if(!$properties) {
            # alert message using session
            dump('Alert Message: The real estate property information not found in the database.');
            return redirect('property/change');
        }
        else {
              #access the request using this and apply laravel validation rules on inputs
              $this->validate($request,[
                'propertyNumber' => 'required|numeric|min:1|max:1000000',
                'propertyName' => 'required',
                'propertyAddress' => 'required',
                'propertyType' => 'required',
                'propertySizeBd' => 'required|numeric|min:1|max:9',
                'propertySizeBd' => 'required|numeric|min:1|max:9',
                'propertySizeBd' => 'required|numeric|min:1|max:9',
                'livingArea' => 'required|numeric|min:1|max:10000',
                'lotSize' => 'required|numeric|min:0.01|max:10000',
                'yearBuilt' => 'required|numeric|min:1000|max:2017',
                'salePrice' => 'required|numeric|min:1|max:100000000',
                'taxRate' => 'required|numeric|min:0|max:10',
                'hoaYearly' => 'required|numeric|min:1|max:10000'
              ]);

              # get loan data from the form using request and format/calculate for display
              $propertyNumber = $request->propertyNumber;
              $propertyName = $request->propertyName;
              $propertyAddress = $request->propertyAddress;
              $propertyType = $request->propertyType;
              $propertySizeBd = $request->propertySizeBd;
              $propertySizeBa = $request->propertySizeBa;
              $propertySizeGa = $request->propertySizeGa;
              $livingArea = $request->livingArea;
              $lotSize = $request->lotSize;
              $yearBuilt = $request->yearBuilt;
              $salePrice = $request->salePrice;
              $taxRate = $request->taxRate;
              $hoaYearly = $request->hoaYearly;
              $propertySize = $propertySizeBd.'bd-'.$propertySizeBa.'ba-'.$propertySizeGa.'ga';

              #Save scenario to the database
              $properties->property_number = $propertyNumber;
              $properties->property_name = $propertyName;
              $properties->property_address = $propertyAddress;
              $properties->property_type = $propertyType;
              $properties->property_size = $propertySize;
              $properties->living_area = $livingArea;
              $properties->lot_size = $lotSize;
              $properties->year_built = $yearBuilt;
              $properties->sale_price = $salePrice;
              $properties->tax_rate = $taxRate;
              $properties->hoa_yearly = $hoaYearly;
              # Save the changes
              $properties->save();
              # confirmaiton session message
              Session::flash('message', 'Confirmation Message: Real Estate Property information updated.');
        # redirect back to property update page
        return redirect('/property/update/'.$request->id);

    }
  } #end of updateProperty method

  public function stagePropertyRemoval($id) {
      # retrieve model filtered by property id
      $properties = Property::where('id', $id)->first();
      # condition if for Property being in the database
      if(!$properties) {
          # alert session message and reurn redirect
          dump('Alert Message: The real estate property information not found in the database.');
          return redirect('property/delete');
      }
      # return view with properties
      return view('property.remove')->with(
          'properties', $properties
      );
  } #end of stagePropertyRemoval method


  public function removeProperty(Request $request) {
      # retrieve models filtered by property id
      $properties = Property::where('id', $request->id)->first();
      $featureProperties = FeatureProperty::where('property_id', $request->id)->get();
      $scenarios = Scenario::where('property_id', $request->id)->get();
      # condition if the property does not exist
      if(!$properties) {
          # alert session message
          dump('Alert Message: The real estate property information not found in the database.');
          return redirect('property/delete');
      }
      else {
          # delete rows from all three table in specific order to address database key constraints
          FeatureProperty::where('property_id', $request->id)->delete();
          Scenario::where('property_id', $request->id)->delete();
          Property::where('id', $request->id)->delete();
          # confirmation message
          Session::flash('message', 'Confirmation Message: The real estate property information was removed from the database successfully.');
      # retrn redirect to delete landing page
      return redirect('/property/delete');
    }
  } #end of removeProperty method


  public function loadFeatures() {
      # retrieve model
      $properties = Property::All();
      # extract is using pluck method from the data
      $id = $properties->pluck('id');
      # return view with properties data and id
      return view('property.loadfeatures')->with([
          'id' => $id,
          'properties' => $properties
      ]);

  } #end of loadFeatures method

  public function viewFeatures($id) {
      # retrieve data from the models
      $features = Feature::All();
      $properties = Property::where('id',$id)->first();
      $propertyfeatures = FeatureProperty::where('property_id', $id)->get();
      # declare array and load with foreach loop
      $array_feature=[];
      foreach ($propertyfeatures as $propertyfeature) {
          $array_feature[]=$propertyfeature->feature_id;
      }
      # pass array to the model data for filtering
      $featureSelected = Feature::whereIn('id',$array_feature)->get();

      # return view with filtered model data and record id
      return view('property.viewfeatures')->with([
          'id'=> $id,
         'features' => $features,
         'properties' => $properties,
         'propertyfeatures' => $propertyfeatures,
         'featureSelected' => $featureSelected,
      ]);

  } #end of viewFeature method

  public function addFeatures($id) {
      # retrieve data from the models
      $features = Feature::All();
      $properties = Property::find($id);
      $propertyfeatures = FeatureProperty::where('property_id', $id)->get();
      # declare array and load with foreach loop
      $array_feature=[];
      foreach ($propertyfeatures as $propertyfeature) {
          $array_feature[]=$propertyfeature->feature_id;
      }
      # pass array to the model data for filtering
      $featureSelected = Feature::whereIn('id',$array_feature)->get();
      $features = $features->whereNotIn('id',$array_feature);
      # Reference: Use of whereNotIn. http://stackoverflow.com/questions/25849015/laravel-eloquent-where-not-in
      # return view with filtered model data and record id
      return view('property.addfeatures')->with([
          'id'=> $id,
         'features' => $features,
         'properties' => $properties,
         'propertyfeatures' => $propertyfeatures,
         'featureSelected' => $featureSelected,
      ]);
  } #end of addFeature method

  public function saveFeatures(Request $request) {
          # retrieve data from the models
          $features = Feature::All();
          $propertyfeatures = FeatureProperty::All();
          #access the request using this and apply laravel validation rules on inputs
          $this->validate($request,[
            'featureSelect' => 'required|not_in:0',
          ]);
          # conditional if the record in pivot table is not found
          if(!$propertyfeatures) {
               Session::flash('message', 'Confirmation Message: The prperty feature not found in the database, cannot add/update record.');
           }
           else {
          # extraction of data from the form
          $property_id = $request->id;
          $feature_id = $request->input('featureSelect');
          #Save scenario to the database
          $propertyfeatures = new FeatureProperty();
          $propertyfeatures->property_id = $property_id;
          $propertyfeatures->feature_id = $feature_id;
          $propertyfeatures->save();
          # confirmation message using session for saving the record to the database
          Session::flash('message', 'Confirmation Message: The key feature is attached to the real estate property and saved to the database successfully.');
          # redirecting back to the same page after addition
          return redirect('/property/addfeatures/'.$request->id);
          }
  } #end of saveFeatures

  public function removeFeature($id) {
      # retrieve models
      $features = Feature::All();
      $properties = Property::find($id);
      $propertyfeatures = FeatureProperty::where('property_id', $id)->get();
      # declare array and load up using foreach loop on pivot table
      $array_feature=[];
      foreach ($propertyfeatures as $propertyfeature) {
          $array_feature[]=$propertyfeature->feature_id;
      }
      # loadup variables for feature selection and display
      $featureSelected = $features->whereIn('id',$array_feature);
      $featureAmend = $features->whereIn('id',$array_feature);

      # return view with model data and id
      return view('property.removefeature')->with([
          'id'=> $id,
         'features' => $features,
         'properties' => $properties,
         'propertyfeatures' => $propertyfeatures,
         'featureSelected' => $featureSelected,
         'featureAmend' => $featureAmend,
      ]);
} #end of removeFeature function


  public function deleteFeature(Request $request) {
    # retrieve models
    $properties = Property::where('id', $request->id)->first();
    $propertyfeatures = FeatureProperty::where('property_id', $request->id)->get();
    #access the request using this and apply laravel validation rules on inputs
    $this->validate($request,[
      'featureSelect' => 'required|not_in:0',
    ]);
    # declare array and load up using foreach loop on pivot table
    $array_feature=[];
    foreach ($propertyfeatures as $propertyfeature) {
        $array_feature[]=$propertyfeature->feature_id;
    }
    # retrieve features for the property for removal
    $featureSelected = Feature::whereIn('id',$array_feature)->get();
    # perform delete operation;
    FeatureProperty::where('property_id', $request->id)->where('feature_id', $request->featureSelect)->delete();
    # confirmation message feature removing from the database
    Session::flash('message', 'Confirmation Message: The key feature is removed and detached from the real estate property and the database successfully.');
    # return back to the removal form
    return redirect('/property/removefeature/'.$request->id);
  } #end of deleteFeature method

}
