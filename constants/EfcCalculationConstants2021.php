<?php
class EfcCalculationConstants2021
{
	/* 2020-2021: Table A1 */
	public $stateTaxAllowanceIncomeThreshold = 15000;

	/* 2020-2021: Table A1, first column */
	public $parentStateTaxAllowancePercents = array(
		3, // Other
		3, // Alabama
		2, // Alaska
		3, // American Samoa
		4, // Arizona
		4, // Arkansas
		8, // Calfornia
		3, // Canada and Canadian Provinces
		4, // Colorado
		9, // Connecticut
		5, // Delaware
		7, // District of Columbia
		3, // Federated States of Micronesia
		3, // Florida
		5, // Georgia
		3, // Guam
		5, // Hawaii
		5, // Idaho
		5, // Illinois
		4, // Indiana
		5, // Iowa
		4, // Kansas
		5, // Kentucky
		3, // Louisiana
		6, // Maine
		3, // Marshall Islands
		8, // Maryland
		7, // Massachusetts
		3, // Mexico
		4, // Michigan
		6, // Minnesota
		3, // Mississippi
		5, // Missouri
		5, // Montana
		5, // Nebraska
		2, // Nevada
		4, // New Hampshire
		9, // New Jersey
		3, // New Mexico
		9, // New York
		5, // North Carolina
		2, // North Dakota
		3, // Northern Mariana Islands
		5, // Ohio
		3, // Oklahoma
		7, // Oregon
		3, // Palau
		5, // Pennsylvania
		3, // Puerto Rico
		6, // Rhode Island
		4, // South Carolina
		2, // South Dakota
		2, // Tennessee
		3, // Texas
		5, // Utah
		6, // Vermont
		3, // Virgin Islands
		6, // Virginia
		3, // Washington
		3, // West Virginia
		6, // Wisconsin
		2  // Wyoming
	);

	/* 2020-2021: Table A7 */
	public $studentStateTaxAllowancePercents = array(
		2, // Other
		2, // Alabama
		0, // Alaska
		2, // American Samoa
		2, // Arizona
		3, // Arkansas
		6, // California
		2, // Canada and Canadian Provinces
		3, // Colorado
		5, // Connecticut
		3, // Delaware
		6, // District of Columbia
		2, // Federated States of Micronesia
		1, // Florida
		3, // Georgia
		2, // Guam
		4, // Hawaii
		3, // Idaho
		3, // Illinois
		3, // Indiana
		3, // Iowa
		2, // Kansas
		4, // Kentucky
		2, // Louisiana
		3, // Maine
		2, // Marshall Islands
		6, // Maryland
		4, // Massachusetts
		2, // Mexico
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
		2, // Northern Mariana Islands
		3, // Ohio
		2, // Oklahoma
		5, // Oregon
		2, // Palau
		3, // Pennsylvania
		2, // Puerto Rico
		3, // Rhode Island
		3, // South Carolina
		1, // South Dakota
		1, // Tennessee
		1, // Texas
		3, // Utah
		3, // Vermont
		2, // Virgin Islands
		4, // Virginia
		1, // Washington
		3, // West Virginia
		4, // Wisconsin
		1 // Wyoming
	);

	/* 2020-2021: Table A2 */
	public $socialSecurityTaxIncomeThresholds = array(0, 128400, 200000);

	/* 2020-2021: Table A2 */
	public $socialSecurityTaxPercentages = array(0.0765, 0.0145, 0.0235);

	/* 2020-2021: Table A2 */
	public $socialSecurityTaxBases = array(0, 9822.60, 10860.80);

	/* 2020-2021: Worksheet */
	public $dependentStudentIncomeProtectionAllowance = 6840;

	/* 2020-2021: Table A3 */
	public $dependentParentIncomeProtectionAllowances = array(
		array( 0, 0, 0, 0, 0, 0 ),
		array( 0, 0, 0, 0, 0, 0 ),
		array( 0, 19080, 15810, 0, 0, 0 ),
		array( 0, 23760, 20510, 17250, 0, 0 ),
		array( 0, 34620, 31350, 28110, 24840, 21600 ),
		array( 0, 40490, 37230, 33980, 30720, 27470 )
	);

	/* 2020-2021: Table C3 */
	public $independentWithDependentsIncomeProtectionAllowances = array(
		array( 0, 0, 0, 0, 0, 0 ),
		array( 0, 0, 0, 0, 0, 0 ),
		array( 0, 26940, 22340, 0, 0, 0 ),
		array( 0, 33550, 28960, 24360, 0, 0 ),
		array( 0, 41420, 36830, 32250, 27630, 0 ),
		array( 0, 48880, 44260, 39680, 35080, 30500 ),
		array( 0, 57160, 52560, 47990, 43360, 38790 )
	);

	/* 2020-2021: Worksheet */
	public $singleIndependentWithoutDependentsIncomeProtectionAllowance = 10640;

	/* 2020-2021: Worksheet */
	public $marriedIndependentWithoutDependentsIncomeProtectionAllowance = 17060;

	/* 2020-2021: Table A3 */
	public $dependentAdditionalFamilyAllowance = 4750;

	/* 2020-2021: Table A3 */
	public $dependentAdditionalStudentAllowance = 3250;

	/* 2020-2021: Table C3 */
	public $independentAdditionalFamilyAllowance = 6450;

	/* 2020-2021: Table C3 */
	public $independentAdditionalStudentAllowance = 4580;

	/* 2020-2021: Worksheet */
	public $employmentExpensePercent = 0.35;

	/* 2020-2021: Worksheet */
	public $employmentExpenseMaximum = 4000;

	/* 2020-2021: Worksheet */
	public $aiAssessmentPercent = 0.5;

	/* 2020-2021: Table A4 */
	public $businessFarmNetWorthAdjustmentRanges = array(1, 135000, 410000, 680000);

	/* 2020-2021: Table A4 */
	public $businessFarmNetWorthAdjustmentBases = array(0, 54000, 191500, 353500);

	/* 2020-2021: Table A4 */
	public $businessFarmNetWorthAdjustmentPercents = array(40, 50, 60, 100);

	/* 2020-2021: Table A5 */
	public $assetProtectionAllowanceLowestAge = 25;

	/* 2020-2021: Table A5 */
	public $marriedAssetProtectionAllowances = array(
		0,
		300,
		700,
		1000,
		1300,
		1600,
		2000,
		2300,
		2600,
		2900,
		3300,
		3600,
		3900,
		4200,
		4600,
		4900,
		5100,
		5200,
		5300,
		5400,
		5500,
		5700,
		5800,
		6000,
		6100,
		6300,
		6400,
		6600,
		6800,
		6900,
		7100,
		7300,
		7500,
		7700,
		7900,
		8200,
		8400,
		8600,
		8900,
		9200,
		9400
	);

	/* 2020-2021: Table A5 */
	public $singleAssetProtectionAllowances = array(
		0,
		100,
		200,
		300,
		500,
		600,
		700,
		800,
		900,
		1000,
		1100,
		1200,
		1400,
		1500,
		1600,
		1700,
		1700,
		1700,
		1800,
		1800,
		1900,
		1900,
		1900,
		2000,
		2000,
		2100,
		2100,
		2200,
		2200,
		2300,
		2300,
		2400,
		2500,
		2500,
		2600,
		2700,
		2700,
		2800,
		2900,
		2900,
		3000
	);

	/* 2020-2021: Worksheet */
	public $dependentStudentAssetRate = 0.2;

	/* 2020-2021: Worksheet */
	public $dependentParentAssetRate = 0.12;

	/* 2020-2021: Worksheet */
	public $independentWithDependentsAssetRate = 0.07;

	/* 2020-2021: Worksheet */
	public $independentWithoutDependentsAssetRate = 0.2;

	/* 2020-2021: Table A6 */
	public $aaiContributionRanges = array(-3409, 17000, 21400, 25700, 30100, 34500);

	/* 2020-2021: Table A6 */
	public $aaiContributionBases = array(0, 3740, 4840, 6087, 7583, 9343);

	/* 2020-2021: Table A6 */
	public $aaiContributionPercents = array(22, 25, 29, 34, 40, 47);

	public $simplifiedEFCMax = 49999;

	public $autoZeroEFCMax = 26000;

	public $altEnrollmentIncomeProtectionAllowance = 5280;
}
?>
