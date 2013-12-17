Exam Matrix
it is a online quiz application where user can create unlimited test and show them on their wordpress blog, 
the basic quiz structure is give below.

STRUCTURE

Quiz
  |
  ----- Set
        |
        ----- Subset
                |
                ------ Questions

It's very simple, first create a set and creat some subset for that set and then add some question to subset and finally
add set to quiz.

Installation

1:- Install the plugin by uploading via wordpress
2:- Create a Set , then create some subset for belonging set
3:- Add question to set/subset using add question page
4:- Create a quiz ( is a custom post type 'test' )
5:- set setting for that quiz
6:- add question set to that quiz

Adding theme support (optional)

1:- create single-ex_test.php with your theme html structure
2:- copy template.inc from plugins/exam-matrix/template
3:- paste it in your theme folder
4:- include it in your single-ex_test.php 
ie.
<!--
<?php get_header(); ?>
<div class="page">
    <div class="container">
        <?php get_sidebar(); ?>
        <div class="content">
            <div class="data">
                <?php require_once('template.inc'); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?> 
-->