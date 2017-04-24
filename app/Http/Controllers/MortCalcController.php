<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Scenario; # to use the Scenario Model;

class MortCalcController extends Controller
{
  # main view function - landing page / default for reset
  public function index() {
        return view('index');
  }

  # readme view function
  public function readme() {
        return view('readme');
  }

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

  }

  public function AddScenario() {

        # Instantiate a new Book Model object
        $scenario = new Scenario();

        # Set the parameters
        # Note how each parameter corresponds to a field in the table
        $scenario->scenario_number =7;
        $scenario->scenario_name = 'phi';
        $scenario->loan_amount = 100000;
        $scenario->interest_rate_annual = 6.0;
        $scenario->interest_rate_monthly = 0.5;
        $scenario->interest_type = 'fixed';
        $scenario->loan_duration_years = 30;
        $scenario->loan_duration_months = 360;
        $scenario->loan_monthly_payment = 599.95;
        $scenario->interest_total_paid = 115338.33;
        $scenario->interest_rate_average = 0.5;
        $scenario->loan_total_cost = 215338.33;
        $scenario->loan_payments_count = 360;

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $scenario->save();

        dump('Added: '.$scenario->scenario_name);
    }

    public function readScenario() {

        $scenario = Scenario::all();
        dump($scenario->toArray());
    }


    public function updateScenario() {

    # First get a book to update
    $scenario = Scenario::where('scenario_name', 'LIKE', '%alpha%')->first();

    if(!$scenario) {
        dump("Scenario not found, can't update.");
    }
    else {

        # Change some properties
        $scenario->scenario_name = 'zeta';
        $scenario->loan_duration_years = 30;

        # Save the changes
        $scenario->save();

        dump('Update complete; check the database to confirm the update worked.');
    }
  }


  public function deleteScenario() {

  # First get a book to delete
  $scenario = Scenario::where('scenario_name', 'LIKE', '%phita%')->first();

  if(!$scenario) {
      dump('Did not delete- Book not found.');
  }
  else {
      $scenario->delete();
      dump('Deletion complete; check the database to see if it worked...');
  }
}

}
