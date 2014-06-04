<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1.0;" />

    <title>Financial Aid Estimator</title>

    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="../style/main.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
    <div id="root">
    
        <h1>Financial Aid Estimator</h1>
        <h2>University Name</h2>

        <h3>Welcome to the Financial Aid Estimator!</h3>

        <p>
            The Financial Aid Estimator provides an estimated Financial Aid Award Letter for prospective students.
            The estimated values produced by this tool are <strong>not</strong>
            the actual amounts that will be offered in your final Financial Aid Award Letter.
            All estimated values are <strong>subject to the availability of funding</strong>.
            To begin the actual Financial Aid application process, complete a <a href="http://www.fafsa.ed.gov/">FAFSA</a>.
        </p>
        
        <p>
            This estimator only produces <strong>estimated values</strong> based on the information you provide. If you provide
            incorrect information, the resulting estimated values may differ significantly from your final Financial Aid award
            letter. Furthermore, your final Financial Aid award letter can be affected by a number of factors:
        </p>
        
        <ul>
            <li>The <strong>number of units</strong> you complete during an academic quarter</li>
            <li><strong>Private scholarships</strong> from external agencies</li>
            <li><strong>Specific requirements</strong> to each type of aid</li>
        </ul>
        
        <p>
            This tool is only intended for <strong>full-time, undergraduate students</strong>. <strong>Graduate students</strong>
            should contact the Financial Aid office or their department directly for more information.
        </p>
        
        <p>
            Please choose either the <strong>Dependent</strong> or <strong>Independent</strong> estimator to continue:
        </p>
        
        <ul class="dependency-choice">
            <li class="button-wrapper">
                <a href="dependent.php" class="button">
                    Dependent Estimator
                    <span>I am <strong>less</strong> than 24 years old</span>
                </a>
            </li>
            <li class="button-wrapper">
                <a href="independent.php" class="button">
                    Independent Estimator
                    <span>I am <strong>at least</strong> 24 years old</span>
                </a>
            </li>
        </ul>

        <p>
            Students who are less than 24 years old may still qualify for Independent status. For more information,
            <a href="http://www.fafsa.ed.gov/help/fftoc02k.htm">view the Dependency Status criteria</a>.
        </p>

    </div>
</body>
</html>
