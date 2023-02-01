@php
$category_ids = [1,2,3,4,5,6,7,8];
$table = 'lflb_sub_categories';
$contents['stories'] = DB::table($table)->whereIn('lflb_sub_categories.category_id', $category_ids)->get();

foreach ($contents['stories'] as $story) {
$array[$story->id] = explode(",", $story->stories);
// $stories_by_sub_category[]
}
$int_only = [];
foreach ($array as $id => $stories) {
$stories = array_unique($stories);
sort($stories);
echo "INSERT INTO lflb_story_lflb_sub_category(lflb_story_id, lflb_sub_category_id) VALUES".PHP_EOL;
foreach ($stories as $story) {
echo "(".$story.",".$id."),".PHP_EOL ;
}

}
@endphp
