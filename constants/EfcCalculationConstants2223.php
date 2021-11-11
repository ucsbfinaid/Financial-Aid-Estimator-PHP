<?php
class EfcCalculationConstants2223
{
	/* 2022-2023: Table 1 */
	public $stateTaxAllowanceIncomeThreshold = 15000;

	/* 2022-2023: Table 1, first column */
	public $parentStateTaxAllowancePercents = array(
		2, // Other
		3, // Alabama
		2, // Alaska
		2, // American Samoa
		4, // Arizona
		4, // Arkansas
		9, // California
		2, // Canada and Canadian Provinces
		4, // Colorado
		9, // Connecticut
		5, // Delaware
		7, // District of Columbia
		2, // Federated States of Micronesia
		3, // Florida
		5, // Georgia
		2, // Guam
		5, // Hawaii
		5, // Idaho
		6, // Illinois
		4, // Indiana
		5, // Iowa
		4, // Kansas
		5, // Kentucky
		3, // Louisiana
		6, // Maine
		2, // Marshall Islands
		8, // Maryland
		7, // Massachusetts
		2, // Mexico
		5, // Michigan
		7, // Minnesota
		3, // Mississippi
		5, // Missouri
		5, // Montana
		5, // Nebraska
		3, // Nevada
		4, // New Hampshire
		9, // New Jersey
		3, // New Mexico
		10, // New York
		5, // North Carolina
		2, // North Dakota
		2, // Northern Mariana Islands
		5, // Ohio
		3, // Oklahoma
		7, // Oregon
		2, // Palau
		5, // Pennsylvania
		2, // Puerto Rico
		6, // Rhode Island
		4, // South Carolina
		2, // South Dakota
		2, // Tennessee
		3, // Texas
		5, // Utah
		6, // Vermont
		2, // Virgin Islands
		6, // Virginia
		3, // Washington
		3, // West Virginia
		6, // Wisconsin
		2  // Wyoming
	);

	/* 2022-2023: Table 1 */
	public $studentStateTaxAllowancePercents = array(
		1, // Other
		2, // Alabama
		0, // Alaska
		1, // American Samoa
		2, // Arizona
		3, // Arkansas
		6, // California
		1, // Canada and Canadian Provinces
		3, // Colorado
		5, // Connecticut
		3, // Delaware
		6, // District of Columbia
		1, // Federated States of Micronesia
		1, // Florida
		4, // Georgia
		1, // Guam
		4, // Hawaii
		4, // Idaho
		3, // Illinois
		3, // Indiana
		3, // Iowa
		3, // Kansas
		4, // Kentucky
		2, // Louisiana
		3, // Maine
		1, // Marshall Islands
		6, // Maryland
		4, // Massachusetts
		1, // Mexico
		3, // Michigan
		5, // Minnesota
		2, // Mississippi
		3, // Missouri
		3, // Montana
		3, // Nebraska
		1, // Nevada
		1, // New Hampshire
		5, // New Jersey
		2, // New Mexico
		7, // New York
		3, // North Carolina
		1, // North Dakota
		1, // Northern Mariana Islands
		3, // Ohio
		2, // Oklahoma
		5, // Oregon
		1, // Palau
		3, // Pennsylvania
		1, // Puerto Rico
		4, // Rhode Island
		3, // South Carolina
		1, // South Dakota
		1, // Tennessee
		1, // Texas
		4, // Utah
		3, // Vermont
		1, // Virgin Islands
		4, // Virginia
		1, // Washington
		3, // West Virginia
		4, // Wisconsin
		1 // Wyoming
	);

	/* 2022-2023: Table 3 */
	public $socialSecurityTaxIncomeThresholds = array(0, 137700, 200000);

	/* 2022-2023: Table 3 */
	public $socialSecurityTaxPercentages = array(0.0765, 0.0145, 0.0235);

	/* 2022-2023: Table 3 */
	public $socialSecurityTaxBases = array(0, 10534.05, 11437.80);

	/* 2022-2023: Worksheet */
	public $dependentStudentIncomeProtectionAllowance = 7040;

	/* 2022-2023: Table 4 */
	public $dependentParentIncomeProtectionAllowances = array(
		array( 0, 0, 0, 0, 0, 0 ),
		array( 0, 0, 0, 0, 0, 0 ),
		array( 0, 19630, 16270, 0, 0, 0 ),
		array( 0, 24440, 21100, 17740, 0, 0 ),
		array( 0, 30190, 26830, 23490, 20130, 0),
		array( 0, 35620, 32260, 28920, 25560, 22220 ),
		array( 0, 41670, 38310, 34970, 31610, 28270 )
	);

	/* 2022-2023: Table 5 */
	public $independentWithDependentsIncomeProtectionAllowances = array(
		array( 0, 0, 0, 0, 0, 0 ),
		array( 0, 0, 0, 0, 0, 0 ),
		array( 0, 27720, 22980, 0, 0, 0 ),
		array( 0, 34520, 29800, 25060, 0, 0 ),
		array( 0, 42620, 37900, 33180, 28430, 0 ),
		array( 0, 50300, 45550, 40830, 36100, 31380 ),
		array( 0, 58820, 54090, 49380, 44620, 39910 )
	);

	/* 2022-2023: Worksheet */
	public $singleIndependentWithoutDependentsIncomeProtectionAllowance = 10950;

	/* 2022-2023: Worksheet */
	public $marriedIndependentWithoutDependentsIncomeProtectionAllowance = 17550;

	/* 2022-2023: Table 4 */
	public $dependentAdditionalFamilyAllowance = 4700;

	/* 2022-2023: Table 4 */
	public $dependentAdditionalStudentAllowance = 3340;

	/* 2022-2023: Table 5 */
	public $independentAdditionalFamilyAllowance = 6640;

	/* 2022-2023: Table 5 */
	public $independentAdditionalStudentAllowance = 4720;

	/* 2022-2023: Worksheet */
	public $employmentExpensePercent = 0.35;

	/* 2022-2023: Worksheet */
	public $employmentExpenseMaximum = 4000;

	/* 2022-2023: Worksheet */
	public $aiAssessmentPercent = 0.5;

	/* 2022-2023: Table 6 */
	public $businessFarmNetWorthAdjustmentRanges = array(1, 140000, 420000, 700000);

	/* 2022-2023: Table 6 */
	public $businessFarmNetWorthAdjustmentBases = array(0, 56000, 196000, 364000);

	/* 2022-2023: Table 6 */
	public $businessFarmNetWorthAdjustmentPercents = array(40, 50, 60, 100);

	/* 2022-2023: Table 7 */
	public $assetProtectionAllowanceLowestAge = 25;

	/* 2022-2023: Table 7 */
	public $marriedAssetProtectionAllowances = array(
		0,
		200,
		400,
		600,
		800,
		1000,
		1200,
		1400,
		1700,
		1900,
		2100,
		2300,
		2500,
		2700,
		2900,
		3100,
		3200,
		3200,
		3300,
		3400,
		3500,
		3600,
		3700,
		3700,
		3800,
		3900,
		4000,
		4100,
		4200,
		4400,
		4500,
		4600,
		4700,
		4900,
		5000,
		5100,
		5300,
		5400,
		5600,
		5800,
		5900
	);

	/* 2022-2023: Table A5 */
	public $singleAssetProtectionAllowances = array(
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0,
		0
	);

	/* 2022-2023: Worksheet */
	public $dependentStudentAssetRate = 0.2;

	/* 2022-2023: Worksheet */
	public $dependentParentAssetRate = 0.12;

	/* 2022-2023: Worksheet */
	public $independentWithDependentsAssetRate = 0.07;

	/* 2022-2023: Worksheet */
	public $independentWithoutDependentsAssetRate = 0.2;

	/* 2022-2023: Table 8 */
	public $aaiContributionRanges = array(-3409, 17500, 22000, 26500, 31000, 35500);

	/* 2022-2023: Table 8 */
	public $aaiContributionBases = array(0, 3850, 4975, 6280, 7810, 9494);

	/* 2022-2023: Table 8 */
	public $aaiContributionPercents = array(22, 25, 29, 34, 40, 47);

	public $simplifiedEFCMax = 49999;

	public $autoZeroEFCMax = 27000;

	public $altEnrollmentIncomeProtectionAllowance = 5430;
}
?>
