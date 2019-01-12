<?php
declare(strict_types=1);

use PawelWankiewiczRekrutacjaHRtec\Commands\Command;

$GLOBALS = [
    "OUTPUT_FILE_NAME" => "file.csv",
    "URL" => "http://feeds.nationalgeographic.com/ng/News/News_Main",
    "OUTPUT_DIRECTORY" => "output/",
    "COLUMNS_HEADERS" => ["title", "description", "link", "pubDate", "creator"]
];
require("Output/OutputInterface.php");
require("Output/Csv/CsvOutput.php");
require("Output/Csv/SimpleCsvOutput.php");
require("Output/Csv/CsvOutputFactory.php");
require("Output/Csv/ExtendedCsvOutput.php");
require("Resource/ResourceInterface.php");
require("Resource/Rss/RssResource.php");
require("Resource/Rss/RssResourceFactory.php");
require("Commands/Help.php");
require("Commands/Csv.php");
require("Commands/Command.php");

$client = new Command($argv);