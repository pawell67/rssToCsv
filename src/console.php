<?php
declare(strict_types=1);

$GLOBALS = [
    "OUTPUT_FILE_NAME" => "file.csv",
    "URL" => "http://feeds.nationalgeographic.com/ng/News/News_Main",
    "OUTPUT_DIRECTORY" => "output/",
    "COLUMNS_HEADERS" => ["title", "description", "link", "pubDate", "creator"]
];

use PawelWankiewiczRekrutacjaHRtec\Output\Csv\CsvOutputFactory;

require("Output/OutputInterface.php");
require("Output/Csv/CsvOutput.php");
require("Output/Csv/SimpleCsvOutput.php");
require("Output/Csv/CsvOutputFactory.php");
require("Output/Csv/ExtendedCsvOutput.php");
require("Resource/ResourceInterface.php");
require("Resource/Rss/RssResource.php");
require("Resource/Rss/RssResourceFactory.php");


$client = new CsvOutputFactory();
$client->createExtendedCsvOutput($argv)->saveToFile();

