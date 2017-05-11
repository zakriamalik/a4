<?php
   # Display file to show amortization table schedule
   # Reference: Got ideas about tables from the followin website and developed code around it:
   # http://stackoverflow.com/questions/4746079/how-to-create-a-html-table-from-a-php-array
echo "<table id='tblAmortSchedule'>"; #Table declaration & generation
echo "<tr>
          <th>Pmt No</th>
          <th>Month Year</th>
          <th>Loan Amount ($)</th>
          <th>Interest Rate Monthly (%)</th>
          <th>Monthly Payment ($)</th>
          <th>Interest ($)</th>
          <th>Principal ($)</th>
          <th>Loan Balance ($)</th>
       </tr>"; #Table header

   # Run a loop iterating from first monthly payment to the last (based on the number of months in the loan term)
 for($j = 1; $j <= $loanMonths; $j++) {
   # Table rows 'tr' with columns 'td'. The table is populated dynamically as the loop runs from first payment to last
echo "<tr> \n\r";
echo "<td>".$array_pmtNo[$j]."</td>";
echo "<td>".$array_date[$j]."</td>"; #see reference 3 below
echo "<td>".number_format($array_loan[$j], 2, '.', ',')."</td>";
echo "<td>".$array_interestRateMonthly[$j]."</td>";
echo "<td>".number_format($array_monthlyPayment[$j], 2, '.', ',')."</td>";
echo "<td>".number_format($array_interest[$j], 2, '.', ',')."</td>"; #see reference 1 below
echo "<td>".number_format($array_principal[$j], 2, '.', ',')."</td>";
echo "<td>".number_format($array_loanBalance[$j], 2, '.', ',')."</td>"; #see reference 2 below
echo "</tr>";
}
echo "</table>";
echo "*Last row represents the remaining balance, if +ive money is owed to bank, if -ive consumer gets refund. ";
echo "<br />\n";
echo "**Variable Interest Rate changes just the distribution of monthly payment between interest and loan balance. ";
echo "<br />\n";
echo "***Month Year date column starts from next month from today with fully loaded months. Does not take into consideration of partial months. ";
echo "<br />\n";
#Reference 1: Formula for Monthly interest calculations: http://homeguides.sfgate.com/calculate-principal-interest-mortgage-2409.html
#Reference 2: Learned and leveraged this site to understand syntax for number format function. http://php.net/manual/en/function.number-format.php
#Reference 3: Diplay of month & increment: http://stackoverflow.com/questions/5347217/simplest-way-to-display-current-month-year-in-php-like-aug-2016
#Reference 4: Getting current date. http://stackoverflow.com/questions/10586615/current-date-2-months
#Reference 5: New line and break technique leveraged. http://stackoverflow.com/questions/2674703/php-trying-to-create-a-new-line-with-n

?>
