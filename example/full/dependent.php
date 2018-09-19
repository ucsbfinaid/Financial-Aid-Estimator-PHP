<?php
    // Set up autoloading for classes
    spl_autoload_register(function ($class) {
        include dirname(dirname(dirname(__FILE__)))
          . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR
          . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    });

    use Ucsb\Sa\FinAid\AidEstimation\Utility\AidEstimationValidator;
    use Ucsb\Sa\FinAid\AidEstimation\Utility\EfcCalculatorFactory;
    use Ucsb\Sa\FinAid\AidEstimation\Utility\RawDependentEfcCalculatorArguments;

    EfcCalculatorFactory::$constantsPath = dirname(dirname(dirname(__FILE__)))
      . DIRECTORY_SEPARATOR . 'constants' . DIRECTORY_SEPARATOR;

    // Create a utility function for retrieving POST values
    function getPost($key) {
        return isset($_POST[$key]) ? htmlentities($_POST[$key]) : null;
    }

    $formState = '';
    $rawArgs = new RawDependentEfcCalculatorArguments();

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // Collect user input
        $rawArgs->oldestParentAge = getPost('oldest-parent-age');
        $rawArgs->maritalStatus = getPost('marital-status');
        $rawArgs->stateOfResidency = getPost('state-of-residency');

        $rawArgs->isFirstParentWorking = getPost('first-parent-working');
        $rawArgs->firstParentWorkIncome = getPost('first-parent-work-income');
        $rawArgs->isSecondParentWorking = getPost('second-parent-working');
        $rawArgs->secondParentWorkIncome = getPost('second-parent-work-income');
        $rawArgs->isStudentWorking = getPost('student-working');
        $rawArgs->studentWorkIncome = getPost('student-work-income');

        $rawArgs->parentAgi = getPost('parent-agi');
        $rawArgs->areParentsTaxFilers = getPost('are-parents-tax-filers');
        $rawArgs->parentIncomeTax = getPost('parent-income-tax');
        $rawArgs->parentUntaxedIncomeAndBenefits = getPost('parent-untaxed-income-and-benefits');
        $rawArgs->parentAdditionalFinancialInfo = getPost('parent-additional-financial-information');

        $rawArgs->studentAgi = getPost('student-agi');;
        $rawArgs->isStudentTaxFiler = getPost('is-student-tax-filer');
        $rawArgs->studentIncomeTax = getPost('student-income-tax');
        $rawArgs->studentUntaxedIncomeAndBenefits = getPost('student-untaxed-income-and-benefits');
        $rawArgs->studentAdditionalFinancialInfo = getPost('student-additional-financial-information');

        $rawArgs->parentCashSavingsChecking = getPost('parent-cash-savings-checking');
        $rawArgs->parentInvestmentNetWorth = getPost('parent-investment-net-worth');
        $rawArgs->parentBusinessFarmNetWorth = getPost('parent-business-farm-net-worth');

        $rawArgs->studentCashSavingsChecking = getPost('student-cash-savings-checking');
        $rawArgs->studentInvestmentNetWorth = getPost('student-investment-net-worth');
        $rawArgs->studentBusinessFarmNetWorth = getPost('student-business-farm-net-worth');

        $rawArgs->numberInHousehold = getPost('number-in-household');
        $rawArgs->numberInCollege = getPost('number-in-college');

        $rawArgs->monthsOfEnrollment = "9";
        $rawArgs->isQualifiedForSimplified = "false";

        // Validate user input
        $validator = new AidEstimationValidator();
        $args = $validator->validateDependentEfcCalculatorArguments($rawArgs);

        // If validation fails, display errors
        if ($validator->hasErrors())
        {
            $formState = 'error';
        }
        else
        {
            // Calculate
            $calculator = EfcCalculatorFactory::getEfcCalculator("1920");
            $efcProfile = $calculator->getDependentEfcProfile($args);

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
    <form method="post" action="dependent.php" runat="server">
        <ul>
            <li>
                <label for="oldest-parent-age">Age of Oldest Parent:</label>
                <input type="text" id="oldest-parent-age" name="oldest-parent-age" value="<?php echo $rawArgs->oldestParentAge; ?>" />
            </li>
            <li>
                <fieldset>
                    <legend>Parent(s)' Marital Status</legend>
                    <ul>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="parent-marital-status-single" name="marital-status" value="single" <?php if($rawArgs->maritalStatus == 'single') { echo 'checked'; }  ?> />
                            <label for="parent-marital-status-single">Single/Separated/Divorced</label>
                        </li>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="parent-marital-status-married" name="marital-status" value="married" <?php if($rawArgs->maritalStatus == 'married') { echo 'checked'; }  ?> />
                            <label for="parent-marital-status-married">Married/Remarried</label>
                        </li>
                    </ul>
                </fieldset>
            </li>
            <li>
                <fieldset>
                    <legend>Did the First Parent Work?</legend>
                    <ul>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="first-parent-working-yes" name="first-parent-working" value="true" <?php if($rawArgs->isFirstParentWorking == 'true') { echo 'checked'; }  ?> />
                            <label for="first-parent-working-yes">Yes, the First Parent worked</label>
                        </li>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="first-parent-working-no" name="first-parent-working" value="false" <?php if($rawArgs->isFirstParentWorking == 'false') { echo 'checked'; }  ?> />
                            <label for="first-parent-working-no">No, the First Parent did <em>not</em> work</label>
                        </li>
                    </ul>
                </fieldset>
            </li>
            <li>
                <label for="first-parent-work-income">First Parent's Income Earned From Work</label>
                <input type="text" id="first-parent-work-income" name="first-parent-work-income" value="<?php echo $rawArgs->firstParentWorkIncome; ?>" />
            </li>
            <li>
                <fieldset>
                    <legend>Did the Second Parent Work?</legend>
                    <ul>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="second-parent-working-yes" name="second-parent-working" value="true" <?php if($rawArgs->isSecondParentWorking == 'true') { echo 'checked'; }  ?> />
                            <label for="second-parent-working-yes">Yes, the Second Parent worked</label>
                        </li>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="second-parent-working-no" name="second-parent-working" value="false" <?php if($rawArgs->isSecondParentWorking == 'false') { echo 'checked'; }  ?> />
                            <label for="second-parent-working-no">No, the Second Parent did <em>not</em> work</label>
                        </li>
                    </ul>
                </fieldset>
            </li>
            <li>
                <label for="second-parent-work-income">Second Parent's Income Earned From Work</label>
                <input type="text" id="second-parent-work-income" name="second-parent-work-income" value="<?php echo $rawArgs->secondParentWorkIncome; ?>" />
            </li>
            <li>
                <fieldset>
                    <legend>Did the Student Work?</legend>
                    <ul>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="student-working-yes" name="student-working" value="true" <?php if($rawArgs->isStudentWorking == 'true') { echo 'checked'; }  ?> />
                            <label for="student-working-yes">Yes, the Student worked</label>
                        </li>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="student-working-no" name="student-working" value="false" <?php if($rawArgs->isStudentWorking == 'false') { echo 'checked'; }  ?> />
                            <label for="student-working-no">No, the Student did <em>not</em> work</label>
                        </li>
                    </ul>
                </fieldset>
            </li>
            <li>
                <label for="student-work-income">Student's Income Earned From Work</label>
                <input type="text" id="student-work-income" name="student-work-income" value="<?php echo $rawArgs->studentWorkIncome; ?>" />
            </li>
            <li>
                <label for="parent-agi">Parent(s)' Adjusted Gross Income (AGI)</label>
                <input type="text" id="parent-agi" name="parent-agi" value="<?php echo $rawArgs->parentAgi; ?>" />
            </li>
            <li>
                <fieldset>
                    <legend>Did Parent(s) File Taxes?</legend>
                    <ul>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="are-parents-tax-filers-yes" name="are-parents-tax-filers" value="true" <?php if($rawArgs->areParentsTaxFilers == 'true') { echo 'checked'; }  ?> />
                            <label for="are-parents-tax-filers-yes">Yes, my Parent(s) filed taxes</label>
                        </li>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="are-parents-tax-filers-no" name="are-parents-tax-filers" value="false" <?php if($rawArgs->areParentsTaxFilers == 'false') { echo 'checked'; }  ?> />
                            <label for="are-parents-tax-filers-no">No, my Parent(s) did <em>not</em> file taxes</label>
                        </li>
                    </ul>
                </fieldset>
            </li>
            <li>
                <label for="parent-income-tax">Parent(s)' Income Tax Paid</label>
                <input type="text" id="parent-income-tax" name="parent-income-tax" value="<?php echo $rawArgs->parentIncomeTax; ?>" />
            </li>
            <li>
                <label for="parent-untaxed-income-and-benefits">
                    Parent(s)' Untaxed Income and Benefits
                    <span class="description">Including child support and money received from friends or relatives</span>
                </label>
                <input type="text" id="parent-untaxed-income-and-benefits" name="parent-untaxed-income-and-benefits" value="<?php echo $rawArgs->parentUntaxedIncomeAndBenefits; ?>" />
            </li>
            <li>
                <label for="parent-additional-financial-information">
                    Parent(s)' Additional Financial Information
                </label>
                <input type="text" id="parent-additional-financial-information" name="parent-additional-financial-information" value="<?php echo $rawArgs->parentAdditionalFinancialInfo; ?>" />
            </li>
            <li>
                <label for="student-agi">Student's Adjusted Gross Income (AGI)</label>
                <input type="text" id="student-agi" name="student-agi" value="<?php echo $rawArgs->studentAgi; ?>" />
            </li>
            <li>
                <fieldset>
                    <legend>Did the Student File Taxes?</legend>
                    <ul>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="is-student-tax-filer-yes" name="is-student-tax-filer" value="true" <?php if($rawArgs->isStudentTaxFiler == 'true') { echo 'checked'; }  ?> />
                            <label for="is-student-tax-filer-yes">Yes, I filed taxes</label>
                        </li>
                        <li class="radio-input-wrapper">
                            <input type="radio" id="is-student-tax-filer-no" name="is-student-tax-filer" value="false" <?php if($rawArgs->isStudentTaxFiler == 'false') { echo 'checked'; }  ?> />
                            <label for="is-student-tax-filer-no">No, I did <em>not</em> file taxes</label>
                        </li>
                    </ul>
                </fieldset>
            </li>
            <li>
                <label for="student-income-tax">Student's Income Tax Paid</label>
                <input type="text" id="student-income-tax" name="student-income-tax" value="<?php echo $rawArgs->studentIncomeTax; ?>" />
            </li>
            <li>
                <label for="student-untaxed-income-and-benefits">
                    Student's Untaxed Income and Benefits
                    <span class="description">Including child support and money received from friends or relatives</span>
                </label>
                <input type="text" id="student-untaxed-income-and-benefits" name="student-untaxed-income-and-benefits" value="<?php echo $rawArgs->studentUntaxedIncomeAndBenefits; ?>" />
            </li>
            <li>
                <label for="student-additional-financial-information">
                    Student's Additional Financial Information
                </label>
                <input type="text" id="student-additional-financial-information" name="student-additional-financial-information" value="<?php echo $rawArgs->studentAdditionalFinancialInfo; ?>" />
            </li>
            <li>
                <label for="parent-cash-savings-checking">Parent(s)' Cash, Savings, and Checking</label>
                <input type="text" id="parent-cash-savings-checking" name="parent-cash-savings-checking" value="<?php echo $rawArgs->parentCashSavingsChecking; ?>" />
            </li>
            <li>
                <label for="parent-investment-net-worth">Net Worth of Parent(s)' Investments</label>
                <input type="text" id="parent-investment-net-worth" name="parent-investment-net-worth" value="<?php echo $rawArgs->parentInvestmentNetWorth; ?>" />
            </li>
            <li>
                <label for="parent-business-farm-net-worth">Net Worth of Parent(s)' Business and/or Investment Farm</label>
                <input type="text" id="parent-business-farm-net-worth" name="parent-business-farm-net-worth" value="<?php echo $rawArgs->parentBusinessFarmNetWorth; ?>" />
            </li>
            <li>
                <label for="student-cash-savings-checking">Student's Cash, Savings, and Checking</label>
                <input type="text" id="student-cash-savings-checking" name="student-cash-savings-checking" value="<?php echo $rawArgs->studentCashSavingsChecking; ?>" />
            </li>
            <li>
                <label for="student-investment-net-worth">Net Worth of Student's Investments</label>
                <input type="text" id="student-investment-net-worth" name="student-investment-net-worth" value="<?php echo $rawArgs->studentInvestmentNetWorth; ?>" />
            </li>
            <li>
                <label for="student-business-farm-net-worth">Net Worth of Student's Business and/or Investment Farm</label>
                <input type="text" id="student-business-farm-net-worth" name="student-business-farm-net-worth" value="<?php echo $rawArgs->studentBusinessFarmNetWorth; ?>" />
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
			<li>
				<span class="result-label">
					Parent Contribution
					<span class="description">Amount that your parents are expected to contribute towards the cost of your education</span>
				</span>
				<span class="plus-operator">+</span><span class="result-amount">$<?php echo number_format($efcProfile->parentContribution, 2, '.', ','); ?></span>
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
			<a href="dependent.php" class="button">&laquo; Return to Calculator</a>
		</span>
	</div>
    <?php endif; ?>

</div>
</body>
</html>
