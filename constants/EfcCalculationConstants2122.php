<?php
class EfcCalculationConstants2122
{
	/* 2021-2022: Table 1 */
	public $stateTaxAllowanceIncomeThreshold = 15000;

	/* 2021-2022: Table 1, first column */
	public $parentStateTaxAllowancePercents = array(
		2, // Other
		3, // Alabama
		2, // Alaska
		2, // American Samoa
		4, // Arizona
		4, // Arkansas
		9, // Calfornia
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

	/* 2021-2022: Table 1 */
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

	/* 2021-2022: Table 3 */
	public $socialSecurityTaxIncomeThresholds = array(0, 132900, 200000);

	/* 2021-2022: Table 3 */
	public $socialSecurityTaxPercentages = array(0.0765, 0.0145, 0.0235);

	/* 2021-2022: Table 3 */
	public $socialSecurityTaxBases = array(0, 10166.85, 11139.80);

	/* 2021-2022: Worksheet */
	public $dependentStudentIncomeProtectionAllowance = 6970;

	/* 2021-2022: Table 4 */
	public $dependentParentIncomeProtectionAllowances = array(
		array( 0, 0, 0, 0, 0, 0 ),
		array( 0, 0, 0, 0, 0, 0 ),
		array( 0, 19440, 16110, 0, 0, 0 ),
		array( 0, 24200, 20900, 17570, 0, 0 ),
		array( 0, 29890, 26570, 23260, 19930, 0),
		array( 0, 35270, 31940, 28640, 25310, 22000 ),
		array( 0, 41250, 37930, 34620, 31300, 27990 )
	);

	/* 2021-2022: Table C3 */
	public $independentWithDependentsIncomeProtectionAllowances = array(
		array( 0, 0, 0, 0, 0, 0 ),
		array( 0, 0, 0, 0, 0, 0 ),
		array( 0, 27450, 22760, 0, 0, 0 ),
		array( 0, 34180, 29510, 24810, 0, 0 ),
		array( 0, 42200, 37520, 32850, 28150, 0 ),
		array( 0, 49800, 45100, 40430, 35750, 31080 ),
		array( 0, 58240, 53550, 48900, 44180, 39520 )
	);

	/* 2021-2022: Worksheet */
	public $singleIndependentWithoutDependentsIncomeProtectionAllowance = 10840;

	/* 2021-2022: Worksheet */
	public $marriedIndependentWithoutDependentsIncomeProtectionAllowance = 17380;

	/* 2021-2022: Table 4 */
	public $dependentAdditionalFamilyAllowance = 4660;

	/* 2021-2022: Table 4 */
	public $dependentAdditionalStudentAllowance = 3310;

	/* 2021-2022: Table 5 */
	public $independentAdditionalFamilyAllowance = 6580;

	/* 2021-2022: Table 5 */
	public $independentAdditionalStudentAllowance = 4670;

	/* 2021-2022: Worksheet */
	public $employmentExpensePercent = 0.35;

	/* 2021-2022: Worksheet */
	public $employmentExpenseMaximum = 4000;

	/* 2021-2022: Worksheet */
	public $aiAssessmentPercent = 0.5;

	/* 2021-2022: Table 6 */
	public $businessFarmNetWorthAdjustmentRanges = array(1, 140000, 415000, 695000);

	/* 2021-2022: Table 6 */
	public $businessFarmNetWorthAdjustmentBases = array(0, 56000, 193500, 361500);

	/* 2021-2022: Table 6 */
	public $businessFarmNetWorthAdjustmentPercents = array(40, 50, 60, 100);

	/* 2021-2022: Table 7 */
	public $assetProtectionAllowanceLowestAge = 25;

	/* 2021-2022: Table 7 */
	public $marriedAssetProtectionAllowances = array(
		0,
		400,
		700,
		1100,
		1500,
		1800,
		2200,
		2600,
		2900,
		3300,
		3700,
		4000,
		4400,
		4800,
		5100,
		5500,
		5600,
		5700,
		5900,
		6000,
		6200,
		6300,
		6500,
		6600,
		6800,
		7000,
		7100,
		7300,
		7500,
		7700,
		7900,
		8100,
		8400,
		8600,
		8800,
		9100,
		9300,
		9600,
		9900,
		10200,
		10500
	);

	/* 2021-2022: Table A5 */
	public $singleAssetProtectionAllowances = array(
		0,
		100,
		300,
		400,
		600,
		700,
		800,
		1000,
		1100,
		1300,
		1400,
		1500,
		1700,
		1800,
		2000,
		2100,
		2200,
		2200,
		2300,
		2300,
		2400,
		2400,
		2500,
		2500,
		2600,
		2700,
		2700,
		2800,
		2900,
		2900,
		3000,
		3100,
		3100,
		3200,
		3300,
		3400,
		3500,
		3600,
		3700,
		3800,
		3900
	);

	/* 2021-2022: Worksheet */
	public $dependentStudentAssetRate = 0.2;

	/* 2021-2022: Worksheet */
	public $dependentParentAssetRate = 0.12;

	/* 2021-2022: Worksheet */
	public $independentWithDependentsAssetRate = 0.07;

	/* 2021-2022: Worksheet */
	public $independentWithoutDependentsAssetRate = 0.2;

	/* 2021-2022: Table 8 */
	public $aaiContributionRanges = array(-3409, 17400, 21800, 26200, 30700, 35100);

	/* 2021-2022: Table 8 */
	public $aaiContributionBases = array(0, 3828, 4928, 6204, 7734, 9494);

	/* 2021-2022: Table 8 */
	public $aaiContributionPercents = array(22, 25, 29, 34, 40, 47);

	public $simplifiedEFCMax = 49999;

	public $autoZeroEFCMax = 27000;

	public $altEnrollmentIncomeProtectionAllowance = 5380;
}
?>
