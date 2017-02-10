<?php
class EfcCalculationConstants1718
{
	/* 2017-2018: Table A1 */
	public $stateTaxAllowanceIncomeThreshold = 15000;

	/* 2017-2018: Table A1, first column */
	public $parentStateTaxAllowancePercents = array(
	  	2, // Other
	  	3, // Alabama
	  	2, // Alaska
	  	2, // AmericanSamoa
	  	4, // Arizona
	  	4, // Arkansas
	  	8, // California
	  	2, // CanadaAndCanadianProvinces
	  	4, // Colorado
	  	9, // Connecticut
	  	5, // Delaware
	  	8, // DistrictOfColumbia
	  	2, // FederatedStatesOfMicronesia
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
	  	2, // MarshallIslands
	  	8, // Maryland
	  	7, // Massachusetts
	  	2, // Mexico
	  	5, // Michigan
	  	6, // Minnesota
	  	3, // Mississippi
	  	5, // Missouri
	  	5, // Montana
	  	5, // Nebraska
	  	2, // Nevada
	  	5, // NewHampshire
	  	9, // NewJersey
	  	3, // NewMexico
	  	10, // NewYork
	  	5, // NorthCarolina
	  	2, // NorthDakota
	  	2, // NorthernMarianaIslands
	  	5, // Ohio
	  	3, // Oklahoma
	  	7, // Oregon
	  	2, // Palau
	  	5, // Pennsylvania
	  	2, // PuertoRico
	  	7, // RhodeIsland
	  	5, // SouthCarolina
	  	2, // SouthDakota
	  	2, // Tennessee
	  	3, // Texas
	  	5, // Utah
	  	6, // Vermont
	  	2, // Virgin Islands
	  	6, // Virginia
	  	3, // Washington
	  	3, // WestVirginia
	  	7, // Wisconsin
	  	2  // Wyoming
		);

	/* 2017-2018: Table A7 */
	public $studentStateTaxAllowancePercents = array(
			1, // Other
			2, // Alabama
			0, // Alaska
			1, // AmericanSamoa
			2, // Arizona
			3, // Arkansas
			6, // California
			1, // CanadaAndCanadianProvinces
			3, // Colorado
			5, // Connecticut
			3, // Delaware
			6, // DistrictOfColumbia
			1, // FederatedStatesOfMicronesia
			1, // Florida
			3, // Georgia
			1, // Guam
			4, // Hawaii
			3, // Idaho
			3, // Illinois
			3, // Indiana
			3, // Iowa
			3, // Kansas
			4, // Kentucky
			2, // Louisiana
			4, // Maine
			1, // MarshallIslands
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
			1, // NewHampshire
			5, // NewJersey
			2, // NewMexico
			7, // NewYork
			4, // NorthCarolina
			1, // NorthDakota
			1, // NorthernMarianaIslands
			3, // Ohio
			2, // Oklahoma
			5, // Oregon
			1, // Palau
			3, // Pennsylvania
			1, // PuertoRico
			4, // RhodeIsland
			3, // SouthCarolina
			1, // SouthDakota
			1, // Tennessee
			1, // Texas
			3, // Utah
			3, // Vermont
			1, // VirginIslands
			4, // Virginia
			1, // Washington
			2, // WestVirginia
			4, // Wisconsin
			1  // Wyoming
		);

	/* 2017-2018: Table A2 */
	public $socialSecurityTaxIncomeThreshold = 118500;

	/* 2017-2018: Table A2 */
	public $socialSecurityLowPercent = 0.0765;

	/* 2017-2018: Table A2 */
	public $socialSecurityHighPercent = 0.0145;

	/* 2017-2018: Table A2 */
	public $socialSecurityHighBase = 9065.25;

	/* 2017-2018: Worksheet */
	public $dependentStudentIncomeProtectionAllowance = 6420;

	/* 2017-2018: Table A3 */
	public $dependentParentIncomeProtectionAllowances = array(
		array(0, 0    , 0    , 0    , 0    , 0    ),
		array(0, 0    , 0    , 0    , 0    , 0    ),
		array(0, 17910, 14840, 0    , 0    , 0    ),
		array(0, 22300, 19250, 16190, 0    , 0    ),
		array(0, 27540, 24480, 21430, 18360, 0    ),
		array(0, 32490, 29430, 26380, 23320, 20270),
		array(0, 38010, 34940, 31900, 28830, 25790),
	);

	/* 2017-2018: Table C3 */
	public $independentWithDependentsIncomeProtectionAllowances = array(
		array(0, 0    , 0    , 0    , 0    , 0    ),
		array(0, 0    , 0    , 0    , 0    , 0    ),
		array(0, 25280, 20960, 0    , 0    , 0    ),
		array(0, 31480, 27180, 22860, 0    , 0    ),
		array(0, 38870, 34560, 30260, 25930, 0    ),
		array(0, 45870, 41540, 37240, 32920, 28620),
		array(0, 53640, 49330, 45040, 40690, 36400),
	);

	/* 2017-2018: Worksheet */
	public $singleIndependentWithoutDependentsIncomeProtectionAllowance = 9980;

	/* 2017-2018: Worksheet */
	public $marriedIndependentWithoutDependentsIncomeProtectionAllowance = 16010;

	/* 2017-2018: Table A3 */
	public $dependentAdditionalFamilyAllowance = 4290;

	/* 2017-2018: Table A3 */
	public $dependentAdditionalStudentAllowance = 3050;

	/* 2017-2018: Table C3 */
	public $independentAdditionalFamilyAllowance = 6060;

	/* 2017-2018: Table C3 */
	public $independentAdditionalStudentAllowance = 4300;

	/* 2017-2018: Worksheet */
	public $employmentExpensePercent = 0.35;

	/* 2017-2018: Worksheet */
	public $employmentExpenseMaximum = 4000;

	/* 2017-2018: Worksheet */
	public $aiAssessmentPercent = 0.5;

	/* 2017-2018: Table A4 */
	public $businessFarmNetWorthAdjustmentRanges = array(1, 130000, 385000, 640000);

	/* 2017-2018: Table A4 */
	public $businessFarmNetWorthAdjustmentBases = array(0, 52000, 179500, 332500);

	/* 2017-2018: Table A4 */
	public $businessFarmNetWorthAdjustmentPercents = array(40, 50, 60, 100);

	/* 2017-2018: Table A5 */
	public $assetProtectionAllowanceLowestAge = 25;

	/* 2017-2018: Table A5 */
	public $marriedAssetProtectionAllowances = array(
		0,
		1100,
		2200,
		3400,
		4500,
		5600,
		6700,
		7800,
		9000,
		10100,
		11200,
		12300,
		13400,
		14600,
		15700,
		16800,
		17100,
		17500,
		17900,
		18400,
		18800,
		19300,
		19800,
		20200,
		20700,
		21200,
		21700,
		22400,
		22900,
		23600,
		24100,
		24800,
		25600,
		26200,
		26900,
		27700,
		28500,
		29300,
		30100,
		31100,
		31900
	);

	/* 2017-2018: Table A5 */
	public $singleAssetProtectionAllowances = array(
		0,
		600,
		1300,
		1900,
		2600,
		3200,
		3800,
		4500,
		5100,
		5800,
		6400,
		7000,
		7700,
		8300,
		9000,
		9600,
		9800,
		10000,
		10200,
		10500,
		10700,
		10900,
		11200,
		11400,
		11700,
		12000,
		12200,
		12500,
		12800,
		13200,
		13500,
		13800,
		14100,
		14500,
		14900,
		15200,
		15600,
		16000,
		16400,
		16900,
		17300
	);

	/* 2017-2018: Worksheet */
	public $dependentStudentAssetRate = 0.2;

	/* 2017-2018: Worksheet */
	public $dependentParentAssetRate = 0.12;

	/* 2017-2018: Worksheet */
	public $independentWithDependentsAssetRate = 0.07;

	/* 2017-2018: Worksheet */
	public $independentWithoutDependentsAssetRate = 0.2;

	/* 2017-2018: Table A6 */
	public $aaiContributionRanges = array(-3409, 16000, 20100, 24200, 28300, 32300);

	/* 2017-2018: Table A6 */
	public $aaiContributionBases = array(0, 3520, 4545, 5734, 7128, 8728);

	/* 2017-2018: Table A6 */
	public $aaiContributionPercents = array(22, 25, 29, 34, 40, 47);

	public $simplifiedEFCMax = 49999;

	public $autoZeroEFCMax = 25000;

	public $altEnrollmentIncomeProtectionAllowance = 4950;
}
?>
