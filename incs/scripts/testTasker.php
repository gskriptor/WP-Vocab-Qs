<?php

$quest_ordered = $wpdb->get_results("SELECT question_id is_correct FROM {$wpdb->prefix}watupro_student_answers WHERE is_correct = 1", ARRAY_A);
$top_qs = $wpdb->get_results("SELECT question_id is_correct FROM {$wpdb->prefix}watupro_student_answers WHERE exam_id = $x_id", ARRAY_A);
var_dump($top_qs);

$corr_count = $wpdb->get_results("SELECT DISTINCT question_id COUNT(is_correct) FROM {$wpdb->prefix}watupro_student_answers WHERE is_correct = 1 AND exam_id = $x_id", ARRAY_A);
var_dump($corr_count);

echo '<br><center><h2>Top 10 Questions</h2></center>';

uksort($quest_ordered, 'is_correct');

foreach($quest_ordered as $qo) {
  $q_id = ()$quest['ID'];
  $corrAnsw_perQuest = $wpdb->get_results("SELECT user_id FROM {$wpdb->prefix}watupro_student_answers WHERE exam_id = $x_id AND question_id = $q_id", ARRAY_A);

}

?>
