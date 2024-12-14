<h1>Loan Calculator</h1>

<p>A Laravel package for calculating loan details, including <b>EMI (Equated Monthly Installment)</b>, <b>Total Cost</b>, <b>Total Interest</b>, and generating a detailed <b>Payment Schedule</b>. This package is ideal for financial applications requiring loan calculations.</p>

<h2>Features</h2>
<ul>
    <li>Calculate <b>EMI</b>, <b>Total Cost</b>, and <b>Total Interest</b> for a loan.</li>
    <li>Generate a <b>Payment Schedule</b> with a month-by-month breakdown of payments.</li>
    <li>Accepts flexible loan terms in both <b>years</b> and <b>months</b>.</li>
    <li>Easy integration with Laravel applications.</li>
</ul>

<hr>

<h2>Installation</h2>

<h3>Step 1: Install via Composer</h3>

<p>Run the installation command:</p>

<pre><code>composer require iamvimukthi/loancalculator:1.0.0</code></pre>

<h3>Step 2: (Optional) Publish Configuration</h3>
<p>To publish the configuration file (if required):</p>

<pre><code>php artisan vendor:publish --provider="Iamvimukthi\Loancalculator\LoanCalculatorService"</code></pre>

<hr>

<h2>Usage</h2>

<h3>1. <b>Calculate Loan Details</b></h3>
<p>Use the <code>calculateLoanDetails</code> method to calculate the EMI, total cost, and total interest for a loan.</p>

<pre><code>
use Iamvimukthi\Loancalculator\LoanCalculator;

$loanAmount = 500000;  // Principal amount
$annualInterestRate = 5;  // Annual interest rate (percentage)
$loanTermYears = 5;  // Loan term in years
$loanTermMonths = 6;  // Additional months

$loanDetails = LoanCalculator::calculateLoanDetails($loanAmount, $annualInterestRate, $loanTermYears, $loanTermMonths);

echo "Monthly EMI: " . number_format($loanDetails['EMI'], 2) . "\n";
echo "Total Cost of Loan: " . number_format($loanDetails['TotalCost'], 2) . "\n";
echo "Total Interest: " . number_format($loanDetails['TotalInterest'], 2) . "\n";
</code></pre>

<p><b>Output Example:</b></p>

<pre><code>
Monthly EMI: 9432.26
Total Cost of Loan: 566136.45
Total Interest: 66136.45
</code></pre>

<h3>2. <b>Generate Payment Schedule</b></h3>
<p>Use the <code>generatePaymentSchedule</code> method to create a detailed payment schedule for the loan.</p>

<pre><code>
$schedule = LoanCalculator::generatePaymentSchedule($loanAmount, $annualInterestRate, $loanTermYears, $loanTermMonths);

foreach ($schedule as $payment) {
    echo "Month-Year: {$payment['MonthYear']}, Principal: " . number_format($payment['PrincipalPayment'], 2) . ", Interest: " . number_format($payment['InterestPayment'], 2) . ", Total: " . number_format($payment['TotalPayment'], 2) . ", Balance: " . number_format($payment['Balance'], 2) . "\n";
}
</code></pre>

<p><b>Output Example:</b></p>

<pre><code>
Month-Year: Jan-2025, Principal: 9361.39, Interest: 4173.21, Total: 9432.26, Balance: 490638.61
Month-Year: Feb-2025, Principal: 9388.67, Interest: 4114.61, Total: 9432.26, Balance: 481249.94
...
</code></pre>

<hr>

<h2>Methods</h2>

<h3><code>calculateLoanDetails($loanAmount, $annualInterestRate, $loanTermYears, $loanTermMonths = 0)</code></h3>
<ul>
    <li><b>Description</b>: Calculates EMI, total cost, and total interest for the given loan.</li>
    <li><b>Parameters</b>:
        <ul>
            <li><code>$loanAmount</code> (float): Principal loan amount.</li>
            <li><code>$annualInterestRate</code> (float): Annual interest rate (percentage).</li>
            <li><code>$loanTermYears</code> (int): Loan term in years.</li>
            <li><code>$loanTermMonths</code> (int): Additional months to add to the loan term (default: 0).</li>
        </ul>
    </li>
    <li><b>Returns</b>: Array containing:
        <ul>
            <li><code>'EMI'</code>: Monthly installment.</li>
            <li><code>'TotalCost'</code>: Total loan cost (principal + interest).</li>
            <li><code>'TotalInterest'</code>: Total interest paid.</li>
        </ul>
    </li>
</ul>

<h3><code>generatePaymentSchedule($loanAmount, $annualInterestRate, $loanTermYears, $loanTermMonths = 0)</code></h3>
<ul>
    <li><b>Description</b>: Generates a detailed payment schedule for the loan.</li>
    <li><b>Parameters</b>:
        <ul>
            <li><code>$loanAmount</code> (float): Principal loan amount.</li>
            <li><code>$annualInterestRate</code> (float): Annual interest rate (percentage).</li>
            <li><code>$loanTermYears</code> (int): Loan term in years.</li>
            <li><code>$loanTermMonths</code> (int): Additional months to add to the loan term (default: 0).</li>
        </ul>
    </li>
    <li><b>Returns</b>: Array containing:
        <ul>
            <li><code>'MonthYear'</code>: Month and year of the payment.</li>
            <li><code>'PrincipalPayment'</code>: Principal portion of the payment.</li>
            <li><code>'InterestPayment'</code>: Interest portion of the payment.</li>
            <li><code>'TotalPayment'</code>: Total payment (EMI).</li>
            <li><code>'Balance'</code>: Remaining loan balance.</li>
        </ul>
    </li>
</ul>

<hr>

<h2>Testing</h2>
<p>Run unit tests for the package using PHPUnit to ensure calculations are accurate.</p>

<pre><code>php artisan test</code></pre>

<p><b>Example test case:</b></p>

<pre><code>
use Iamvimukthi\Loancalculator\LoanCalculator;

class LoanCalculatorTest extends TestCase
{
    public function testCalculateLoanDetails()
    {
        $loanDetails = LoanCalculator::calculateLoanDetails(500000, 5, 5, 6);

        $this->assertEquals(9432.26, $loanDetails['EMI']);
        $this->assertEquals(566136.45, $loanDetails['TotalCost']);
        $this->assertEquals(66136.45, $loanDetails['TotalInterest']);
    }
}
</code></pre>

<hr>

<h2>License</h2>
<p>This package is licensed under the <a href="LICENSE">MIT License</a>.</p>

<h2>Contributing</h2>
<p>Contributions are welcome! Please follow these steps to contribute:</p>
<ol>
    <li>Fork the repository.</li>
    <li>Create a new branch (<code>git checkout -b feature/YourFeature</code>).</li>
    <li>Commit your changes (<code>git commit -m 'Add some feature'</code>).</li>
    <li>Push to the branch (<code>git push origin feature/YourFeature</code>).</li>
    <li>Open a Pull Request.</li>
</ol>

<hr>

<h2>Contact</h2>
<p>For any issues or suggestions, please create an issue on the <a href="https://github.com/IamVimukthi/loan-calculator/issues">GitHub Issues</a> page.</p>
