<?PHP

namespace Jamesrichards\ListGenerator;

use Exception;

/**
 * Generates a list.
 */
class ListGenerator
{
    /**
     * Shuffles an array a given number of times.
     *
     * @param $arr
     * @param $count
     * @return mixed
     */
    public function shuffleArr($arr, $count)
    {
        for ($i = 0; $i < $count; $i++) {
            shuffle($arr);
        }
        return $arr;
    }

    /**
     * Chunks and merges one array into another noting any leftovers.
     *
     * @param array $arr
     * @param array $participants
     * @param int $count
     * @return array
     */
    public function assignItems(array $arr, array $participants, int $count): array
    {
        $chunks = array_chunk($arr, $count);

        $unassignedArr = [];
        while (count($chunks) > count($participants)) {
            $unassignedArr = array_merge($unassignedArr, array_pop($chunks));
        }
        $unassigned["Unassigned"] = $unassignedArr;

        return array_merge(array_combine($participants, $chunks), $unassigned);
    }

    /**
     * Shuffle arrays and chunks and merges one array into another noting any leftovers.
     *
     * @param array $arr
     * @param array $participantsInfo
     * @param int $count
     * @return array
     * @throws Exception
     */
    public function buildList(array $arr, array $participantsInfo, int $count = 3): array
    {
        if (empty($arr) or empty($participantsInfo)) {
            throw new Exception("Given info cannot be empty.");
        }

        $participant_names = $participantsInfo;

        $shuffledList = $this->shuffleArr($arr, $count);
        $shuffledNames = $this->shuffleArr($participant_names, $count);

        $items_per_participant = floor(count($shuffledList) / count($shuffledNames));

        return $this->assignItems($shuffledList, $shuffledNames, $items_per_participant);
    }
};