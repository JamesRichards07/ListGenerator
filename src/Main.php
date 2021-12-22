<?PHP

namespace Jamesrichards\ListGenerator;

class Main
{
    function shuffle_arr($arr, $count)
    {
        for($i=0; $i<$count; $i++)
        {
            shuffle($arr);
        }
        return $arr;
    }
    
    function assign_items(array $arr, array $participants, int $count)
    {
        $chunks = array_chunk($arr, $count);

        $unassignedArr = [];
        while(count($chunks) > count($participants))
        {
            $unassignedArr = array_merge($unassignedArr, array_pop($chunks));
        }
        $unassigned["Unassigned"] = $unassignedArr;

        $result = array_merge(array_combine($participants, $chunks), $unassigned);
        return $result;
    }

    function main(array $arr, array $participantsInfo, int $count = 3): array
    {
        foreach($participantsInfo as $participantInfo){
            $participant_info[$participantInfo->getName()] = $participantInfo->getBlackListedItems();
        }

        $participant_names = array_keys($participant_info);
        
        $shuffledList = $this->shuffle_arr($arr, $count);
        $shuffledNames = $this->shuffle_arr($participant_names, $count);

        $items_per_participant = floor(count($shuffledList)/count($shuffledNames));

        return $this->assign_items($shuffledList, $shuffledNames, $items_per_participant);
    }
};