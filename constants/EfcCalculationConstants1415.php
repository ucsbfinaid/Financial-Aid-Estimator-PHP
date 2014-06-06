<?php
class EfcCalculationConstants1415
{
	/* 2014-2015: Table A1 */
	public $stateTaxAllowanceIncomeThreshold = 15000;

	/* 2014-2015: Table A1, first column */
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
	  	8, // Connecticut
	  	5, // Delaware
	  	7, // DistrictOfColumbia
	  	2, // FederatedStatesOfMicronesia
	  	3, // Florida
	  	5, // Georgia
	  	2, // Guam
	  	4, // Hawaii
	  	5, // Idaho
	  	5, // Illinois
	  	4, // Indiana
	  	5, // Iowa
	  	5, // Kansas
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
	  	3, // Nevada
	  	5, // NewHampshire
	  	9, // NewJersey
	  	3, // NewMexico
	  	9, // NewYork
	  	6, // NorthCarolina
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
	  	2, // Tenessee
	  	3, // Texas
	  	5, // Utah
	  	6, // Vermont
	  	2, // Virgin Islands
	  	6, // Virginia
	  	4, // Washington
	  	3, // WestVirginia
	  	7, // Wisconsin
	  	2  // Wyoming
		);

	/* 2014-2015: Table A7 */
	public $studentStateTaxAllowancePercents = array(
			2, // Other
			2, // Alabama
			0, // Alaska
			2, // AmericanSamoa
			2, // Arizona
			3, // Arkansas
			5, // California
			2, // CanadaAndCanadianProvinces
			3, // Colorado
			5, // Connecticut
			3, // Delaware
			5, // DistrictOfColumbia
			2, // FederatedStatesOfMicronesia
			1, // Florida
			3, // Georgia
			2, // Guam
			3, // Hawaii
			3, // Idaho
			2, // Illinois
			3, // Indiana
			3, // Iowa
			3, // Kansas
			4, // Kentucky
			2, // Louisiana
			4, // Maine
			2, // MarshallIslands
			5, // Maryland
			4, // Massachusetts
			2, // Mexico
			3, // Michigan
			4, // Minnesota
			2, // Mississippi
			3, // Missouri
			3, // Montana
			3, // Nebraska
			1, // Nevada
			1, // NewHampshire
			4, // NewJersey
			2, // NewMexico
			6, // NewYork
			4, // NorthCarolina
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

	/* 2014-2015: Table A2 */
	public $socialSecurityTaxIncomeThreshold = 113700;

	/* 2014-2015: Table A2 */
	public $socialSecurityLowPercent = 0.0765;

	/* 2014-2015: Table A2 */
	public $socialSecurityHighPercent = 0.0145;

	/* 2014-2015: Table A2 */
	public $socialSecurityHighBase = 8698.05;

	/* 2014-2015: Worksheet */
	public $dependentStudentIncomeProtectionAllowance = 6260;

	/* 2014-2015: Table A3 */
	public $dependentParentIncomeProtectionAllowances = array(
		array(0, 0    , 0    , 0    , 0    , 0    ),
		array(0, 0    , 0    , 0    , 0    , 0    ),
		array(0, 17440, 14460, 0    , 0    , 0    ),
		array(0, 21720, 18750, 15770, 0    , 0    ),
		array(0, 26830, 23840, 20870, 17890, 0    ),
		array(0, 31650, 28670, 25700, 22710, 19750),
		array(0, 37020, 34040, 31070, 28090, 25120),
	);


	/* 2014-2015: Table C3 */
	public $independentWithDependentsIncomeProtectionAllowances = array(
		array(0, 0    , 0    , 0    , 0    , 0    ),
		array(0, 0    , 0    , 0    , 0    , 0    ),
		array(0, 24650, 20430, 0    , 0    , 0    ),
		array(0, 30690, 26490, 22280, 0    , 0    ),
		array(0, 37890, 33690, 29500, 25270, 0    ),
		array(0, 44710, 40490, 36300, 32090, 27900),
		array(0, 52290, 48080, 43900, 39670, 35480),
	);

	/* 2014-2015: Worksheet */
	public $singleIndependentWithoutDependentsIncomeProtectionAllowance = 9730;

	/* 2014-2015: Worksheet */
	public $marriedIndependentWithoutDependentsIncomeProtectionAllowance = 15600;

	/* 2014-2015: Table A3 */
	public $dependentAdditionalFamilyAllowance = 4180;

	/* 2014-2015: Table A3 */
	public $dependentAdditionalStudentAllowance = 2970;

	/* 2014-2015: Table C3 */
	public $independentAdditionalFamilyAllowance = 5900;

	/* 2014-2015: Table C3 */
	public $independentAdditionalStudentAllowance = 4190;

	/* 2014-2015: Worksheet */
	public $employmentExpensePercent = 0.35;

	/* 2014-2015: Worksheet */
	public $employmentExpenseMaximum = 4000;

	/* 2014-2015: Worksheet */
	public $aiAssessmentPercent = 0.5;

	/* 2014-2015: Table A4 */
	public $businessFarmNetWorthAdjustmentRanges = array(1, 125000, 375000, 620000);

	/* 2014-2015: Table A4 */
	public $businessFarmNetWorthAdjustmentBases = array(0, 50000, 175000, 322000);

	/* 2014-2015: Table A4 */
	public $businessFarmNetWorthAdjustmentPercents = array(40, 50, 60, 100);

	/* 2014-2015: Table A5 */
	public $assetProtectionAllowanceLowestAge = 25;

	/* 2014-2015: Table A5 */
	public $marriedAssetProtectionAllowances = array(
		0,
		1800,
		3600,
		5500,
		7300,
		9100,
		10900,
		12700,
		14600,
		16400,
		18200,
		20000,
		21800,
		23700,
		25500,
		27300,
		27900,
		28500,
		29200,
		30000,
		30700,
		31500,
		32200,
		33000,
		33800,
		34600,
		35700,
		36500,
		37600,
		38500,
		39700,
		40600,
		41800,
		43000,
		44200,
		45500,
		46800,
		48100,
		49500,
		50900,
		52600
	);

	/* 2014-2015: Table A5 */
	public $singleAssetProtectionAllowances = array(
		0,
		400,
		800,
		1300,
		1700,
		2100,
		2500,
		2900,
		3400,
		3800,
		4200,
		4600,
		5000,
		5500,
		5900,
		6300,
		6500,
		6600,
		6800,
		6900,
		7100,
		7200,
		7400,
		7600,
		7800,
		8000,
		8100,
		8300,
		8500,
		8700,
		9000,
		9200,
		9400,
		9700,
		9900,
		10200,
		10400,
		10700,
		11000,
		11300,
		11600
	);

	/* 2014-2015: Worksheet */
	public $dependentStudentAssetRate = 0.2;

	/* 2014-2015: Worksheet */
	public $dependentParentAssetRate = 0.12;

	/* 2014-2015: Worksheet */
	public $independentWithDependentsAssetRate = 0.07;

	/* 2014-2015: Worksheet */
	public $independentWithoutDependentsAssetRate = 0.2;

	/* 2014-2015: Table A6 */
	public $aaiContributionRanges = array(-3409, 15600, 19600, 23500, 27500, 31500);

	/* 2014-2015: Table A6 */
	public $aaiContributionBases = array(0, 3432, 4432, 5563, 6923, 8523);

	/* 2014-2015: Table A6 */
	public $aaiContributionPercents = array(22, 25, 29, 34, 40, 47);

	public $simplifiedEFCMax = 49999;

	public $autoZeroEFCMax = 24000;

	public $altEnrollmentIncomeProtectionAllowance = 4820;
}
?>