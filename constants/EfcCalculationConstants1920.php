<?php
class EfcCalculationConstants1920
{
	/* 2019-2020: Table A1 */
	public $stateTaxAllowanceIncomeThreshold = 15000;

	/* 2019-2020: Table A1, first column */
	public $parentStateTaxAllowancePercents = array(
	  	3, // Other
	  	3, // Alabama
	  	2, // Alaska
	  	3, // AmericanSamoa
	  	4, // Arizona
	  	4, // Arkansas
	  	8, // California
	  	3, // CanadaAndCanadianProvinces
	  	4, // Colorado
	  	9, // Connecticut
	  	5, // Delaware
	  	7, // DistrictOfColumbia
	  	3, // FederatedStatesOfMicronesia
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
	  	3, // MarshallIslands
	  	8, // Maryland
	  	7, // Massachusetts
	  	3, // Mexico
	  	4, // Michigan
	  	6, // Minnesota
	  	3, // Mississippi
	  	4, // Missouri
	  	5, // Montana
	  	5, // Nebraska
	  	2, // Nevada
	  	4, // NewHampshire
	  	9, // NewJersey
	  	3, // NewMexico
	  	9, // NewYork
	  	5, // NorthCarolina
	  	2, // NorthDakota
	  	3, // NorthernMarianaIslands
	  	5, // Ohio
	  	3, // Oklahoma
	  	7, // Oregon
	  	3, // Palau
	  	5, // Pennsylvania
	  	3, // PuertoRico
	  	6, // RhodeIsland
	  	4, // SouthCarolina
	  	2, // SouthDakota
	  	2, // Tennessee
	  	3, // Texas
	  	5, // Utah
	  	6, // Vermont
	  	3, // Virgin Islands
	  	6, // Virginia
	  	3, // Washington
	  	3, // WestVirginia
	  	6, // Wisconsin
	  	2  // Wyoming
		);

	/* 2019-2020: Table A7 */
	public $studentStateTaxAllowancePercents = array(
			2, // Other
			2, // Alabama
			0, // Alaska
			2, // AmericanSamoa
			2, // Arizona
			3, // Arkansas
			6, // California
			2, // CanadaAndCanadianProvinces
			3, // Colorado
			5, // Connecticut
			3, // Delaware
			6, // DistrictOfColumbia
			2, // FederatedStatesOfMicronesia
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
			2, // MarshallIslands
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
			1, // NewHampshire
			5, // NewJersey
			2, // NewMexico
			7, // NewYork
			3, // NorthCarolina
			1, // NorthDakota
			2, // NorthernMarianaIslands
			3, // Ohio
			2, // Oklahoma
			5, // Oregon
			2, // Palau
			3, // Pennsylvania
			2, // PuertoRico
			4, // RhodeIsland
			3, // SouthCarolina
			1, // SouthDakota
			1, // Tennessee
			1, // Texas
			3, // Utah
			3, // Vermont
			2, // VirginIslands
			4, // Virginia
			1, // Washington
			3, // WestVirginia
			4, // Wisconsin
			1  // Wyoming
		);

	/* 2019-2020: Table A2 */
	public $socialSecurityTaxIncomeThreshold = 127200;

	/* 2019-2020: Table A2 */
	public $socialSecurityLowPercent = 0.0765;

	/* 2019-2020: Table A2 */
	public $socialSecurityHighPercent = 0.0145;

	/* 2019-2020: Table A2 */
	public $socialSecurityHighBase = 9730.80;

	/* 2019-2020: Worksheet */
	public $dependentStudentIncomeProtectionAllowance = 6660;

	/* 2019-2020: Table A3 */
	public $dependentParentIncomeProtectionAllowances = array(
		array(0, 0    , 0    , 0    , 0    , 0    ),
		array(0, 0    , 0    , 0    , 0    , 0    ),
		array(0, 18580, 15400, 0    , 0    , 0    ),
		array(0, 23140, 19980, 16800, 0    , 0    ),
		array(0, 28580, 25400, 22240, 19060, 0    ),
		array(0, 33720, 30540, 27380, 24200, 21040),
		array(0, 39430, 36260, 33100, 29920, 26760),
	);

	/* 2019-2020: Table C3 */
	public $independentWithDependentsIncomeProtectionAllowances = array(
		array(0, 0    , 0    , 0    , 0    , 0    ),
		array(0, 0    , 0    , 0    , 0    , 0    ),
		array(0, 26250, 21760, 0    , 0    , 0    ),
		array(0, 32680, 28210, 23730, 0    , 0    ),
		array(0, 40360, 35880, 31410, 26920, 0    ),
		array(0, 47620, 43120, 38660, 34180, 29710),
		array(0, 55690, 51210, 46750, 42240, 37790),
	);

	/* 2019-2020: Worksheet */
	public $singleIndependentWithoutDependentsIncomeProtectionAllowance = 10360;

	/* 2019-2020: Worksheet */
	public $marriedIndependentWithoutDependentsIncomeProtectionAllowance = 16620;

	/* 2019-2020: Table A3 */
	public $dependentAdditionalFamilyAllowance = 4450;

	/* 2019-2020: Table A3 */
	public $dependentAdditionalStudentAllowance = 3160;

	/* 2019-2020: Table C3 */
	public $independentAdditionalFamilyAllowance = 6290;

	/* 2019-2020: Table C3 */
	public $independentAdditionalStudentAllowance = 4470;

	/* 2019-2020: Worksheet */
	public $employmentExpensePercent = 0.35;

	/* 2019-2020: Worksheet */
	public $employmentExpenseMaximum = 4000;

	/* 2019-2020: Worksheet */
	public $aiAssessmentPercent = 0.5;

	/* 2019-2020: Table A4 */
	public $businessFarmNetWorthAdjustmentRanges = array(1, 130000, 395000, 660000);

	/* 2019-2020: Table A4 */
	public $businessFarmNetWorthAdjustmentBases = array(0, 52000, 184500, 343500);

	/* 2019-2020: Table A4 */
	public $businessFarmNetWorthAdjustmentPercents = array(40, 50, 60, 100);

	/* 2019-2020: Table A5 */
	public $assetProtectionAllowanceLowestAge = 25;

	/* 2019-2020: Table A5 */
	public $marriedAssetProtectionAllowances = array(
		0,
		700,
		1300,
		2000,
		2600,
		3300,
		4000,
		4600,
		5300,
		5900,
		6600,
		7300,
		7900,
		8600,
		9200,
		9900,
		10100,
		10400,
		10600,
		10900,
		11100,
		11400,
		11600,
		11900,
		12200,
		12500,
		12900,
		13200,
		13500,
		13900,
		14300,
		14700,
		15100,
		15500,
		15900,
		16400,
		16800,
		17300,
		17800,
		18300,
		18900
	);

	/* 2019-2020: Table A5 */
	public $singleAssetProtectionAllowances = array(
		0,
		300,
		700,
		1000,
		1400,
		1700,
		2100,
		2400,
		2800,
		3100,
		3500,
		3800,
		4200,
		4500,
		4900,
		5200,
		5300,
		5500,
		5600,
		5700,
		5800,
		6000,
		6100,
		6200,
		6400,
		6500,
		6700,
		6800,
		7000,
		7200,
		7300,
		7500,
		7700,
		7900,
		8100,
		8300,
		8500,
		8800,
		9000,
		9200,
		9500
	);

	/* 2019-2020: Worksheet */
	public $dependentStudentAssetRate = 0.2;

	/* 2019-2020: Worksheet */
	public $dependentParentAssetRate = 0.12;

	/* 2019-2020: Worksheet */
	public $independentWithDependentsAssetRate = 0.07;

	/* 2019-2020: Worksheet */
	public $independentWithoutDependentsAssetRate = 0.2;

	/* 2019-2020: Table A6 */
	public $aaiContributionRanges = array(-3409, 16600, 20800, 25100, 29300, 33600);

	/* 2019-2020: Table A6 */
	public $aaiContributionBases = array(0, 3652, 4702, 5949, 7377, 9097);

	/* 2019-2020: Table A6 */
	public $aaiContributionPercents = array(22, 25, 29, 34, 40, 47);

	public $simplifiedEFCMax = 49999;

	public $autoZeroEFCMax = 26000;

	public $altEnrollmentIncomeProtectionAllowance = 5140;
}
?>
