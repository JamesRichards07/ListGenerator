<?PHP

use Jamesrichards\ListGenerator\DesiredList;
use Jamesrichards\ListGenerator\ListGenerator;
use PHPUnit\Framework\TestCase;


class MainTest extends TestCase
{
    /**
     * @test
     */
    public function testAnErrorIsThrownWhenTryingToAddANonArrayListToAssignItems()
    {
        $this->expectException(TypeError::class);

        $list = "Arborec, Barony of Letnev, Federation of Sol, Emirates of Hacan, Naalu Collective, Nekro Virus";
        $people = ["james", "michael", "brian"];
        $newList = new ListGenerator;

        $actual = $newList->buildList($list, $people, 2);
    }

    /**
     * @test
     */
    public function testAnErrorIsThrownWhenTryingToAddANonArrayPeopleToAssignItems()
    {
        $this->expectException(TypeError::class);

        $list = ["Arborec",
            "Barony of Letnev",
            "Federation of Sol",
            "Emirates of Hacan",
            "Naalu Collective",
            "Nekro Virus"
        ];
        $people = "james, michael, brian";
        $newList = new ListGenerator;

        $actual = $newList->buildList($list, $people, 2);
    }

    /**
     * @test
     */
    public function testAnErrorIsThrownWhenTryingToAddAnEmptyArrayListToBuildList()
    {
        $this->expectException(Exception::class);

        $list = [];
        $people = ["james, michael, brian"];
        $newList = new ListGenerator();

        $actual = $newList->buildList($list, $people, 2);
    }

    /**
     * @test
     */
    public function testAnErrorIsThrownWhenTryingToAddAnEmptyArrayPeopleToBuildList()
    {
        $this->expectException(Exception::class);

        $list = ["Arborec",
            "Barony of Letnev",
            "Federation of Sol",
            "Emirates of Hacan",
            "Naalu Collective",
            "Nekro Virus"];
        $people = [];
        $newList = new ListGenerator();

        $actual = $newList->buildList($list, $people, 2);
    }

    /**
     * @test
     */
    public function testGenerateList()
    {
        $list = ["Arborec",
            "Barony of Letnev",
            "Federation of Sol",
            "Emirates of Hacan",
            "Naalu Collective",
            "Nekro Virus"
        ];

        $people = ["james", "michael", "brian"];
        $newList = new ListGenerator();

        $actual = $newList->assignItems($list, $people, 2);

        $answer = [
            "james" => ["Arborec", "Barony of Letnev"],
            "michael" => ["Federation of Sol", "Emirates of Hacan"],
            "brian" => ["Naalu Collective", "Nekro Virus"],
            "Unassigned" => []
        ];

        $this->assertEquals($answer, $actual, "Actual did not match expected results.");
    }
}