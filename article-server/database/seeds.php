<?php
require_once "../connection/connection.php";
require_once "migrations/usersTable.php";
require_once "migrations/questionsTable.php";

class UserSeed {
    public static function run($conn) {
        $sql = "INSERT INTO users (id,email,username,password)
        VALUES (1,'yehiaarja@gmail.com','yehiaarja','password')";

        if ($conn->$sql) {
            echo "Values inserted successfully";
        }else {
            echo "Error" . $conn->error;
        }
    }
}


UserSeed::run($conn);

class QuestionSeed {
    public static function run($conn) {
        $sql = "INSERT INTO questions (id,question,answer)

        VALUES (1, 'What is technical debt in machine learning systems?', 'Technical debt refers to the long-term maintenance costs of ML systems due to shortcuts, poor design choices, and accumulating complexity.'),
            (2, 'How does technical debt in ML differ from traditional software technical debt?', 'ML systems have additional complexities like data dependencies, model entanglement, hidden feedback loops, and evolving external environments, making maintenance harder.'),
            (3, 'What is boundary erosion in ML systems?', 'Boundary erosion occurs when ML models blur the clear separation between different system components, making debugging and modification more difficult.'),
            (4, 'What is the CACE principle in machine learning?', 'The CACE (Changing Anything Changes Everything) principle means that modifying one part of an ML system, such as a feature or hyperparameter, can unpredictably impact other parts.'),
            (5, 'How do hidden feedback loops contribute to technical debt?', 'Hidden feedback loops occur when an ML system influences the data it trains on, leading to unintended biases and self-reinforcing errors.'),
            (6, 'What are undeclared consumers in ML systems?', 'Undeclared consumers are unknown or unintended parts of a system that rely on the output of an ML model, making updates risky.'),
            (7, 'Why are data dependencies more expensive than code dependencies in ML?', 'Unlike code dependencies, data dependencies are harder to track and debug, and changes in data quality or sources can break models silently.'),
            (8, 'What is an unstable data dependency?', 'An unstable data dependency is an input feature whose values change unpredictably over time, leading to inconsistent model behavior.'),
            (9, 'What are underutilized data dependencies?', 'These are data inputs that provide little value to a model but increase system complexity, making ML models more fragile and difficult to maintain.'),
            (10, 'What is glue code in ML systems?', 'Glue code refers to excessive custom scripts needed to connect different ML components, increasing maintenance costs and system rigidity.'),
            (11, 'What is a pipeline jungle in ML?', 'A pipeline jungle is a complex and unstructured set of data processing steps, making debugging and scaling difficult.'),
            (12, 'Why are dead experimental codepaths a problem in ML?', 'These are old experimental code branches that remain in production, increasing system complexity and the risk of unexpected failures.'),
            (13, 'How does configuration debt accumulate in ML systems?', 'Over time, ML systems accumulate complex and undocumented configuration settings, making it difficult to track, test, and modify models correctly.'),
            (14, 'Why is monitoring crucial for maintaining ML systems?', 'ML models degrade over time due to changing data distributions, requiring continuous monitoring to ensure performance remains stable.'),
            (15, 'What are prediction bias checks in ML monitoring?', 'These checks compare predicted label distributions with actual labels to detect drifts or unexpected model behavior.'),
            (16, 'What is the role of action limits in ML monitoring?', 'Action limits help prevent ML models from making extreme decisions, reducing the risk of negative real-world consequences.'),
            (17, 'How do changes in the external world contribute to ML technical debt?', 'ML models are trained on historical data, but real-world changes can make models outdated or even harmful if not updated regularly.'),
            (18, 'Why is reproducibility difficult in ML systems?', 'ML systems rely on non-deterministic factors like data sampling, random seeds, and evolving infrastructure, making strict reproducibility challenging.'),
            (19, 'What is cultural debt in ML teams?', 'Cultural debt arises when teams prioritize short-term accuracy gains over long-term maintainability, leading to brittle ML systems.'),
            (20, 'How can ML teams pay off technical debt effectively?', 'By refactoring code, improving testing, reducing dependencies, enforcing better monitoring, and promoting a culture of long-term maintainability.');";
        
        if ($conn->query($sql)) {
            echo "Questions-Answers added successfully";
        }else {
            echo "Error" . $conn->error;
        }
    }
}

QuestionSeed::run($conn);