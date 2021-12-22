<?PHP

require "vendor/autoload.php";

echo 
"\n
Welcome to List Generator where you can randomly assign a list to designated participants. Lets get started! \nWho will be participating? (All characters will be included unless seperated by a comma):";

function getListOfParticipantsFromUser(){
    $participants = trim(readline());
    echo "\n";
    $participants = str_replace(", ", ",", $participants);
    $participants = explode(",", $participants);

    echo "Current participants: \n";
    foreach($participants as $participant)
    {
        echo "{$participant}\n";
    }
    echo "\n";
    echo "Any others? (y/n)";
    $others = trim(readline());
    echo "\n";

    while($others === "y" or $others === "yes" or $others === "Y" or $others ==="Yes" or $others === "YES")
    {
        echo "Who are they?";
        $moreParticipants = trim(readline());
        echo "\n";
        $moreParticipants = str_replace(", ", ",", $moreParticipants);
        $moreParticipants = explode(",", $moreParticipants);
        $participants = array_merge($participants, $moreParticipants);
    
        echo "Current participants: \n";
        foreach($participants as $participant){
            echo "{$participant}\n";
        }
        echo "\n";
        echo "Any others? (y/n)";
        $others = trim(readline());
        echo "\n";
    }

    $people = [];
    foreach($participants as $participant)
    {
        $person = new \Jamesrichards\ListGenerator\Person($participant,[""]);
        $people[$person->getName()] = $person;
    }

    return $people;
}

function getListOfItemsFromUser()
{
    echo "What items would you like to distribute to the participants?\n(All characters will be included unless seperated by a comma): \n";

    $items = trim(readline());
    echo "\n";
    $items = str_replace(", ", ",", $items);
    $items = explode(",", $items);

    echo "Current items: \n";
    foreach($items as $item)
    {
        echo "{$item}\n";
    }
    echo "\n";
    echo "Any others to add? (y/n)";
    $others = trim(readline());
    echo "\n";

    while($others === "y" or $others === "yes" or $others === "Y" or $others ==="Yes" or $others === "YES")
    {
        echo "What are they?";
        $moreItems = trim(readline());
        echo "\n";
        $moreItems = str_replace(", ", ",", $moreItems);
        $moreItems = explode(",", $moreItems);
        $items = array_merge($items, $moreItems);
        
        echo "Current items: \n";
        foreach($items as $item)
        {
            echo "{$item}\n";
        }
        echo "\n";
        echo "Any others? (y/n)";
        $others = trim(readline());
        echo "\n";
    }

    $desiredList = new \Jamesrichards\ListGenerator\DesiredList();
    $desiredList->desiredList = $items;

    return $desiredList->desiredList;
}

function getNumberOfTimesToShuffleFromUser(){
    echo "How many times would you like to shuffle these lists? If a non-number is given, 3 will be used as the default.";
    $num = trim((int)readline());
    echo "\n";
    return $num;
}

$buildList = new \Jamesrichards\ListGenerator\ListGenerator();

$people = getListOfParticipantsFromUser();
$items = getListOfItemsFromUser();
$count = getNumberOfTimesToShuffleFromUser();

$results = $ListGenerator->buildList($items, $people, $count);

echo "Here is your randomized list -\n";
foreach($results as $result=>$result_values)
{
    if($result==="Unassigned")
    {
        if(array() === $result)
        {
            echo "Here are the items which are unassigned:\n";
            foreach($result_values as $result_value)
            {
                echo "$result_value\n";
            }
            echo "\n";
        }
        else
        {
            echo "Congradulations all items were distributed!!";
            echo "\n";
        }
    }
    else
    {
        echo "This is $result's list:\n";
        foreach($result_values as $result_value)
        {
            echo "$result_value\n";
        }
        echo "\n";
    }
}
