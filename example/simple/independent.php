<?php
    // Set up autoloading for classes
    spl_autoload_register(function ($class) {
        include dirname(dirname(dirname(__FILE__)))
          . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR
          . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    });

    use Ucsb\Sa\FinAid\AidEstimation\Utility\AidEstimationValidator;
    use Ucsb\Sa\FinAid\AidEstimation\Utility\EfcCalculatorFactory;
    use Ucsb\Sa\FinAid\AidEstimation\Utility\RawSimpleIndependentEfcCalculatorArguments;

    EfcCalculatorFactory::$constantsPath = dirname(dirname(dirname(__FILE__)))
      . DIRECTORY_SEPARATOR . 'constants' . DIRECTORY_SEPARATOR;

    // Create a utility function for retrieving POST values
    function getPost($key) {
        return isset($_POST[$key]) ? htmlentities($_POST[$key]) : null;
    }

    $formState = '';
    $rawArgs = new RawSimpleIndependentEfcCalculatorArguments();

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // Collect user input
		$rawArgs->studentAge = getPost('student-age');
        $rawArgs->maritalStatus = getPost('marital-status');
        $rawArgs->stateOfResidency = getPost('state-of-residency');
		$rawArgs->studentAge = getPost('student-age');

        $rawArgs->studentIncome = getPost('student-income');
		$rawArgs->studentIncomeEarnedBy = getPost('income-earned-by');
		$rawArgs->studentOtherIncome = getPost('student-other-income');
        $rawArgs->studentIncomeTax = getPost('student-income-tax');
        $rawArgs->studentAssets = getPost('student-assets');

		$rawArgs->hasDependents = getPost('has-dependents');
        $rawArgs->numberInHousehold = getPost('number-in-household');
        $rawArgs->numberInCollege = getPost('number-in-college');

        $rawArgs->monthsOfEnrollment = "9";
        $rawArgs->isQualifiedForSimplified = "false";

        // Validate user input
        $validator = new AidEstimationValidator();
        $args = $validator->validateSimpleIndependentEfcCalculatorArguments($rawArgs);

        // If validation fails, display errors
        if ($validator->hasErrors())
        {
            $formState = 'error';
        }
        else
        {
            // Calculate
            $calculator = EfcCalculatorFactory::getEfcCalculator("1415");
            $efcProfile = $calculator->getIndependentEfcProfile($args);

            // Display Results
            $formState = 'results';
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0;" />

	<title>Dependent Full Aid Estimator Example</title>

    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="../style/main.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="root">

	<h1>Financial Aid Estimator</h1>
	<h2>University Name</h2>

	<p>
		The Financial Aid Estimator provides an estimated Financial Aid Award Letter for prospective students.
		The estimated values produced by this tool are not the actual amounts
		that will be offered in your final Financial Aid Award Letter. All estimated values are <strong>subject to the
		availability of funding</strong>. To begin the actual Financial Aid application process, complete a
		<a href="http://www.fafsa.ed.gov/">FAFSA</a>.
	</p>

    <?php if($formState == "error"): ?>
    <p class="error">There was an error with the values for the following fields:</p>

    <ul class="error error-list">
        <?php foreach($validator->getErrors() as $error): ?>
        <li><?php echo $error->message; ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    <?php if($formState != "results"): ?>
    <form method="post" action="independent.php" runat="server">
        <ul>
            <li>
                <label for="student-age">Age of Student</label>
                <input type="text" id="student-age" name="student-age" value="<?php echo $rawArgs->studentAge; ?>" />
            </li>
            <li>
                <fieldset>
                    <legend>Marital Status</legend>
                    <ul>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="marital-status-single" name="marital-status" value="single" <?php if($rawArgs->maritalStatus == 'single') { echo 'checked'; }  ?> />
                            <label for="marital-status-single">Single/Separated/Divorced</label>
                        </li>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="marital-status-married" name="marital-status" value="married" <?php if($rawArgs->maritalStatus == 'married') { echo 'checked'; }  ?> />
                            <label for="marital-status-married">Married/Remarried</label>
                        </li>
                    </ul>
                </fieldset>
            </li>
            <li>
                <label for="student-income">
					Student and Spouse's Income
					<span class="description">Income earned by student or spouse during the last year</span>
				</label>
                <input type="text" id="student-income" name="student-income" value="<?php echo $rawArgs->studentIncome; ?>" />
            </li>
            <li>
                <fieldset>
                    <legend>Student and Spouse's Income Earned By</legend>
                    <ul>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="income-earned-by-neither" name="income-earned-by" value="none" <?php if($rawArgs->studentIncomeEarnedBy == 'none') { echo 'checked'; }  ?> />
                            <label for="income-earned-by-neither">Neither Student nor Spouse</label>
                        </li>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="income-earned-by-one" name="income-earned-by" value="one" <?php if($rawArgs->studentIncomeEarnedBy == 'one') { echo 'checked'; }  ?> />
                            <label for="income-earned-by-one">Either Student or Spouse</label>
                        </li>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="income-earned-by-both" name="income-earned-by" value="both" <?php if($rawArgs->studentIncomeEarnedBy == 'both') { echo 'checked'; }  ?> />
                            <label for="income-earned-by-both">Both Student and Spouse</label>
                        </li>
                    </ul>
                </fieldset>
            </li>
            <li>
                <label for="student-other-income">
					Student and Spouse's Other Income
					<span class="description">Income earned by student or spouse during the last year that was <em>not</em> reported on their tax return</span>
				</label>
                <input type="text" id="student-other-income" name="student-other-income" value="<?php echo $rawArgs->studentOtherIncome; ?>" />
            </li>
            <li>
                <label for="student-income-tax">Student and Spouse's Income Tax Paid</label>
                <input type="text" id="student-income-tax" name="student-income-tax" value="<?php echo $rawArgs->studentIncomeTax; ?>" />
            </li>
            <li>
                <label for="student-assets">
					Student and Spouse's Assets
					<span class="description">Total value of student and spouse's assets in the last year, including the total amount in cash, savings, and checking, and the net worth of all investments</span>
				</label>
                <input type="text" id="student-assets" name="student-assets" value="<?php echo $rawArgs->studentAssets; ?>" />
            </li>
            <li>
                <fieldset>
                    <legend>Does the Student have dependents?</legend>
                    <ul>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="has-dependents-yes" name="has-dependents" value="true" <?php if($rawArgs->hasDependents == 'true') { echo 'checked'; }  ?> />
                            <label for="has-dependents-yes">Yes, the Student has dependents</label>
                        </li>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="has-dependents-no" name="has-dependents" value="false" <?php if($rawArgs->hasDependents == 'false') { echo 'checked'; }  ?> />
                            <label for="has-dependents-no">No, the Student does <em>not</em> have dependents</label>
                        </li>
                    </ul>
                </fieldset>
            </li>
            <li>
                <label for="number-in-household">
                    Number in Household
                    <span class="description">Total number in your household during the last academic year. Include you, your parents, and your parent(s)' dependents</span>
                </label>
                <input type="text" id="number-in-household" name="number-in-household" value="<?php echo $rawArgs->numberInHousehold; ?>" />
            </li>
            <li>
                <label for="number-in-college">
                    Number in College
                    <span class="description">Total number of people in your household that were in college during the last academic year, not including your parent(s)</span>
                </label>
                <input type="text" id="number-in-college" name="number-in-college" value="<?php echo $rawArgs->numberInCollege; ?>" />
            </li>
            <li>
                <label for="state-of-residency">State of Residency</label>
                <select id="state-of-residency" name="state-of-residency">
                    <option value="Alabama">Alabama</option>
                    <option value="Alaska">Alaska</option>
                    <option value="AmericanSamoa">American Samoa</option>
                    <option value="Arizona">Arizona</option>
                    <option value="Arkansas">Arkansas</option>
                    <option value="California">California</option>
                    <option value="CanadaAndCanadianProvinces">Canada And Canadian Provinces</option>
                    <option value="Colorado">Colorado</option>
                    <option value="Connecticut">Connecticut</option>
                    <option value="Delaware">Delaware</option>
                    <option value="DistrictOfColumbia">District Of Columbia</option>
                    <option value="FederatedStatesOfMicronesia">Federated States Of Micronesia</option>
                    <option value="Florida">Florida</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Guam">Guam</option>
                    <option value="Hawaii">Hawaii</option>
                    <option value="idaho">idaho</option>
                    <option value="Illinois">Illinois</option>
                    <option value="Indiana">Indiana</option>
                    <option value="Iowa">Iowa</option>
                    <option value="Kansas">Kansas</option>
                    <option value="Kentucky">Kentucky</option>
                    <option value="Louisiana">Louisiana</option>
                    <option value="Maine">Maine</option>
                    <option value="MarshallIslands">Marshall Islands</option>
                    <option value="Maryland">Maryland</option>
                    <option value="Massachusetts">Massachusetts</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Michigan">Michigan</option>
                    <option value="Minnesota">Minnesota</option>
                    <option value="Mississippi">Mississippi</option>
                    <option value="Missouri">Missouri</option>
                    <option value="Montana">Montana</option>
                    <option value="Nebraska">Nebraska</option>
                    <option value="Nevada">Nevada</option>
                    <option value="New Hampshire">New Hampshire</option>
                    <option value="NewJersey">New Jersey</option>
                    <option value="NewMexico">New Mexico</option>
                    <option value="NewYork">New York</option>
                    <option value="NorthCarolina">North Carolina</option>
                    <option value="NorthDakota">North Dakota</option>
                    <option value="NorthernMarianaIslands">Northern Mariana Islands</option>
                    <option value="Ohio">Ohio</option>
                    <option value="Oklahoma">Oklahoma</option>
                    <option value="Oregon">Oregon</option>
                    <option value="Palau">Palau</option>
                    <option value="Pennsylvania">Pennsylvania</option>
                    <option value="PuertoRico">Puerto Rico</option>
                    <option value="RhodeIsland">Rhode Island</option>
                    <option value="SouthCarolina">South Carolina</option>
                    <option value="SouthDakota">South Dakota</option>
                    <option value="Tennessee">Tennessee</option>
                    <option value="Texas">Texas</option>
                    <option value="Utah">Utah</option>
                    <option value="Vermont">Vermont</option>
                    <option value="VirginIslands">Virgin Islands</option>
                    <option value="Virginia">Virginia</option>
                    <option value="Washington">Washington</option>
                    <option value="WestVirginia">West Virginia</option>
                    <option value="Wisconsin">Wisconsin</option>
                    <option value="Wyoming">Wyoming</option>
                    <option value="Other">Other</option>
                </select>
            </li>
            </li>
            <li class="button-wrapper">
                <input type="submit" value="Calculate EFC" class="button" id="submit-btn" />
            </li>
        </ul>
    </form>
    <?php endif; ?>

    <?php if($formState == "results"): ?>
	<div class="results-wrapper">
		<h3>Expected Family Contribution</h3>

		<ul class="results">
			<li>
				<span class="result-label">
					Student Contribution
					<span class="description">Amount that you are expected to contribute towards the cost of your education</span>
				</span>
				<span class="result-amount">$<?php echo number_format($efcProfile->studentContribution, 2, '.', ','); ?></span>
			</li>
			<li class="total">
				<span class="result-label">
					Expected Family Contribution
					<span class="description">Sum of the Student Contribution (SC) and Parent Contribution (PC)</span>
				</span>
				<span class="result-amount">$<?php echo number_format($efcProfile->expectedFamilyContribution, 2, '.', ','); ?></span>
			</li>
		</ul>

		<h3>Estimated Total Price of Attendance</h3>

		<ul class="results">
			<li>
				<span class="result-label">
					Tuition and Fees
					<span class="description">Includes cost of education, university health care, and miscellaneous university fees</span>
				</span>
				<span class="result-amount">$99,999.00</span>
			</li>
			<li>
				<span class="result-label">
					Room and Board
					<span class="description">Includes rent, food, and utilities</span>
				</span>
				<span class="plus-operator">+</span>
				<span class="result-amount">$99,999.00</span>
			</li>
			<li>
				<span class="result-label">
					Books and Supplies
					<span class="description">Includes books and supplies</span>
				</span>
				<span class="plus-operator">+</span>
				<span class="result-amount">$99,999.00</span>
			</li>
			<li>
				<span class="result-label">
					Other Expenses
					<span class="description">Includes transportation and miscellaneous personal expenses</span>
				</span>
				<span class="plus-operator">+</span>
				<span class="result-amount">$99,999.00</span>
			</li>
			<li class="total">
				<span class="result-label">
					Total Cost of Attendance
					<span class="description">The total cost of attendance</span>
				</span>
				<span class="result-amount">$99,999.00</span>
			</li>
			<li>
				<span class="result-label">
					Grant Award
					<span class="description">Total estimated Grant Award</span>
				</span>
				<span class="minus-operator">-</span>
				<span class="result-amount">$99,999.00</span>
			</li>
			<li class="total">
				<span class="result-label">
					Estimated Net Cost
					<span class="description">The total cost of attendance that you must contribute towards your education through either loans or out-of-pocket expense</span>
				</span>
				<span class="result-amount">$99,999.00</span>
			</li>
		</ul>

		<p id="cohort-notice">
			<strong>XX%</strong> of first-year full-time dependent, undergraduate students received grant aid in 20XX-20YY
		</p>

		<span class="button-wrapper">
			<a href="independent.php" class="button">&laquo; Return to Calculator</a>
		</span>
	</div>
    <?php endif; ?>

</div>
</body>
</html>
