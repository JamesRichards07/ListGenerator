<?PHP

namespace Jamesrichards\ListGenerator;

class Person
{
    private string $name;
    private array $blackListedItems;

    public array $assignedItems;

    public function __construct($name, $blackListedItems)
    {
        $this->name = $name;
        $this->blackListedItems = $blackListedItems;    
    }

    public function getName()
    {
        return $this->name;
    }

    public function getBlackListedItems()
    {
        return $this->blackListedItems;
    }

    public function setName($name)
    {
        if(is_string($name) && strlen($name) > 1)
        {
            $this->$name=$name;
            return "Name has been updated to {$name}.";
        }
        else
        {
            return "Not a valid name.";
        }
    }

    public function setBlackListedItems($blackListedItems)
    {
        if(is_array($blackListedItems) && count($blackListedItems) > 0)
        {
            $this->$blackListedItems=$blackListedItems;
            return "Blacklisted items have been updated";
        }
        else
        {
            return "No blacklisted items.";
        }
    }
}