<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * SmallWorld
 *
 * @package      \XoopsModules\Smallworld
 * @license      GNU GPL (https://www.gnu.org/licenses/gpl-2.0.html/)
 * @copyright    The XOOPS Project (https://xoops.org)
 * @copyright    2011 Culex
 * @author       Michael Albertsen (http://culex.dk) <culex@culex.dk>
 * @link         https://github.com/XoopsModules25x/smallworld
 * @since        1.0
 */

use XoopsModules\Smallworld;
use XoopsModules\Smallworld\Constants;

require_once __DIR__ . '/header.php';

$GLOBALS['xoopsOption']['template_main'] = 'smallworld_userprofile_regtemplate.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

/** @var \XoopsModules\Smallworld\Helper $helper */
require_once $helper->path('include/functions.php');
require_once $helper->path('include/arrays.php');
/**
 * Vars initialized via inclusion of ./include/arrays.php
 *
 * @var array $arr0
 * @var array $arr01
 * @var array $arr02
 * @var array $arr03
 * @var array $arr04
 * @var array $arr05
 * @var array $arr06
 * @var array $arr7
 */

$GLOBALS['xoopsLogger']->activated = false;

if (!isset($GLOBALS['xoopsUser']) || !$GLOBALS['xoopsUser'] instanceof \XoopsUser) {
    redirect_header(XOOPS_URL . '/register.php', Constants::REDIRECT_DELAY_SHORT, _NOPERM);
}

$id      = $GLOBALS['xoopsUser']->uid();
//$check   = new Smallworld\User();
//$profile = $check->checkIfProfile($id);
$profile = $helper->getHandler('SwUser')->checkIfProfile($id);

// Check if inspected userid -> redirect to userprofile and show admin countdown
$inspect = smallworld_isInspected($id);
if ('yes' === $inspect['inspect']) {
    $helper->redirect('userprofile.php?username=' . $GLOBALS['xoopsUser']->uname(), Constants::REDIRECT_DELAY_SHORT);
}

if ($profile >= Constants::PROFILE_HAS_BOTH) {
    // Create basic user in db & redirect to editProfile.php
    $helper->redirect('editprofile.php');
} else {
    $item = new Smallworld\Form();

    // ------------ PERSONAL INFO ------------ //

    // Real name
    if (0 != smallworldGetValfromArray('realname', 'smallworldusethesefields')) {
        $realname = $item->input('realname', 'realname', 'realname', $size = 30);
        $GLOBALS['xoopsTpl']->append('realname', $realname);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_realname', 'no');
    }

    if (0 != smallworldGetValfromArray('gender', 'smallworldusethesefields')) {
        // Dropdown for gender
        $gender = $item->dropdown('gender', $arr0, 0, '&nbsp;');
        $GLOBALS['xoopsTpl']->append('gender', $gender);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_gender', 'no');
    }

    // Selectbox for "interested in gender(s)"
    if (0 != smallworldGetValfromArray('interestedin', 'smallworldusethesefields')) {
        $intInGender = $item->radio('intingender', $arr01, 0, '&nbsp;');
        $GLOBALS['xoopsTpl']->append('intingender', $intInGender);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_interestedin', 'no');
    }

    // Dropdown for marital status
    if (0 != smallworldGetValfromArray('relationshipstatus', 'smallworldusethesefields')) {
        $relationshipstatus = $item->dropdown('relationship', $arr02, 0);
        $GLOBALS['xoopsTpl']->append('relationshipstatus', $relationshipstatus);

        // Partner. Only shown if marital status is married, it's complicated, engaged)
        $partner = $item->input('partner', 'partner', 'partner', $size = '30', $preset = null);
        $GLOBALS['xoopsTpl']->append('partner', $partner);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_relationshipstatus', 'no');
    }

    // Checkbox for searchin for
    if (0 != smallworldGetValfromArray('lookingfor', 'smallworldusethesefields')) {
        $searchrelat = $item->radio('searchrelat', $arr03, 0);
        $GLOBALS['xoopsTpl']->append('searchrelat', $searchrelat);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_lookingfor', 'no');
    }

    // Select Birthday dd-mm-Y
    if (0 != smallworldGetValfromArray('birthday', 'smallworldusethesefields')) {
        //$birthEle = new \XoopsFormText('', 'birthday', 12, 12);
        //$birthEle->setExtra("class='birthday smallworld_select'");
        //$birthday = $birthEle->render();
        $birthday = $item->input('birthday', 'birthday', 'birthday', $size = '12', $preset = null);
        $GLOBALS['xoopsTpl']->append('birthdaydate', $birthday);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_birthday', 'no');
    }

    // Select Hometown or Enter new
    if (0 != smallworldGetValfromArray('birthplace', 'smallworldusethesefields')) {
        $birthplace = $item->input('birthplace', 'birthplace', 'birthplace', $size = '50', $preset = null);
        $GLOBALS['xoopsTpl']->append('birthplace', $birthplace);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_birthplace', 'no');
    }

    // Dropdown politics
    if (0 != smallworldGetValfromArray('politicalview', 'smallworldusethesefields')) {
        $politic = $item->dropdown('politic', $arr04, 0);
        $GLOBALS['xoopsTpl']->append('politic', $politic);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_political', 'no');
    }

    // Dropdown Religion
    if (0 != smallworldGetValfromArray('religiousview', 'smallworldusethesefields')) {
        $religion = $item->dropdown('religion', $arr05, 0);
        $GLOBALS['xoopsTpl']->append('religion', $religion);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_religion', 'no');
    }

    // ------------ CONTACT INFO ------------ //

    // Add email test
    //function input_add($class, $name, $name2, $rel, $size, $textmore, $preset=null) {
    //$emailtext = $item->input('email','email','email',$size='12',$preset=null);
    if (0 != smallworldGetValfromArray('emails', 'smallworldusethesefields')) {
        $emailtext = $item->input_add('smallworld_add2', 'email', 'emailtype', '.smallworld_clone2', 20, _SMALLWORLD_ADDMORE, $preset = $GLOBALS['xoopsUser']->getVar('email'), 'email-0');
        $emailtext .= "<span class='smallworld_remove' id='emailremove'><a href='javascript:void(0)' id='emailremovelnk'>" . _SMALLWORLD_REMOVE . '</a><br></span>';
        $emailtext .= "<a class='smallworld_addemail' href='javascript:void(0);' id='emailAdd'>" . _SMALLWORLD_ADDMORE . '</a><br><br>';
        $GLOBALS['xoopsTpl']->append('emailtext', $emailtext);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_emails', 'no');
    }

    // Drop down for screen names
    /*dropdown_add ($name, $name2, $rel, array $options, $textmore, $selected=null) {*/
    if (0 != smallworldGetValfromArray('screennames', 'smallworldusethesefields')) {
        $screenname = $item->dropdown_add('smallworld_add', 'screenname', 'screenname_type', '.smallworld_clone', $arr06, _SMALLWORLD_ADDMORE, $selected = null, $preset = null);
        $screenname .= "<span class='smallworld_remove' id='screennameremove'>";
        $screenname .= "<a href='javascript:void(0);' id='screennameremovelnk'>" . _SMALLWORLD_REMOVE . '</a><br></span>';
        $screenname .= "<a class='smallworld_addscreenname' href='javascript:void(0);' id='screennameAdd'>" . _SMALLWORLD_ADDMORE . '</a><br><br>';
        $GLOBALS['xoopsTpl']->append('screenname', $screenname);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_screennames', 'no');
    }

    // Mobilephone
    if (0 != smallworldGetValfromArray('mobile', 'smallworldusethesefields')) {
        $mobile = $item->input('mobile', 'mobile', 'mobile', 12, $preset = null);
        $GLOBALS['xoopsTpl']->append('mobile', $mobile);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_mobile', 'no');
    }

    // Landphone
    if (0 != smallworldGetValfromArray('landphone', 'smallworldusethesefields')) {
        $phone = $item->input('phone', 'phone', 'phone', 12, $preset = null);
        $GLOBALS['xoopsTpl']->append('phone', $phone);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_landphone', 'no');
    }

    // Adress
    if (0 != smallworldGetValfromArray('streetadress', 'smallworldusethesefields')) {
        $adress = $item->input('adress', 'adress', 'adress', $size = '50', $preset = null);
        $GLOBALS['xoopsTpl']->append('adress', $adress);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_adress', 'no');
    }

    if (0 != smallworldGetValfromArray('presentcity', 'smallworldusethesefields')) {
        $present_city = $item->input('present_city', 'present_city', 'present_city', 50, $preset = null);
        $GLOBALS['xoopsTpl']->append('present_city', $present_city);
        $present_country = $item->input('present_country', 'present_country', 'present_country', $size = '50', $preset = null);
        $GLOBALS['xoopsTpl']->append('present_country', $present_country);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_city', 'no');
    }

    if (0 == smallworldGetValfromArray('website', 'smallworldusethesefields')) {
        $GLOBALS['xoopsTpl']->assign('show_website', 'no');
    }

    // ------------ INTERESTS ------------ //

    // Textarea for interests
    //textarea($name, $id, $title, $rows, $cols, $class)
    if (0 != smallworldGetValfromArray('interests', 'smallworldusethesefields')) {
        $interests = $item->textarea('interests', 'interests', _SMALLWORLD_INTERESTS, 1, 20, 'favourites', $preset = $GLOBALS['xoopsUser']->getVar('user_intrest'));
        $GLOBALS['xoopsTpl']->append('interests', $interests);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_interests', 'no');
    }

    // Textarea for Music
    if (0 != smallworldGetValfromArray('favouritemusic', 'smallworldusethesefields')) {
        $music = $item->textarea('music', 'music', _SMALLWORLD_MUSIC, 1, 20, 'favourites');
        $GLOBALS['xoopsTpl']->append('music', $music);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_music', 'no');
    }

    // Textarea for Tvshow
    if (0 != smallworldGetValfromArray('favouritetvshows', 'smallworldusethesefields')) {
        $tvshow = $item->textarea('tvshow', 'tvshow', _SMALLWORLD_TVSHOW, 1, 20, 'favourites');
        $GLOBALS['xoopsTpl']->append('tvshow', $tvshow);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_tv', 'no');
    }

    // Textarea for Movie
    if (0 != smallworldGetValfromArray('favouritemovies', 'smallworldusethesefields')) {
        $movie = $item->textarea('movie', 'movie', _SMALLWORLD_MOVIE, 1, 20, 'favourites');
        $GLOBALS['xoopsTpl']->append('movie', $movie);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_movies', 'no');
    }

    // Textarea for Books
    if (0 != smallworldGetValfromArray('favouritebooks', 'smallworldusethesefields')) {
        $books = $item->textarea('books', 'books', _SMALLWORLD_BOOKS, 1, 20, 'favourites');
        $GLOBALS['xoopsTpl']->append('books', $books);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_books', 'no');
    }

    // Textarea for About me
    if (0 != smallworldGetValfromArray('aboutme', 'smallworldusethesefields')) {
        $aboutme = $item->textarea('aboutme', 'aboutme', _SMALLWORLD_ABOUTME, 2, 20, 'favourites', $preset = $GLOBALS['xoopsUser']->getVar('bio', 'N'));
        $GLOBALS['xoopsTpl']->append('aboutme', $aboutme);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_aboutme', 'no');
    }

    // ------------ SCHOOL ------------ //
    //School name
    if (0 != smallworldGetValfromArray('education', 'smallworldusethesefields')) {
        $school = $item->school_add('smallworld_add3', 'school', 'school_type', '.smallworld_clone3', $arr7, _SMALLWORLD_ADDMORE, $selected = null, $preset = null, $selectedstart = null, $selectedstop = null);
        $school .= "<span class='smallworld_remove2' id='schoolremove'>";
        $school .= "<a href='javascript:void(0);' id='schoolremovelnk'>" . _SMALLWORLD_REMOVE . '</a><br></span>';
        $school .= "<a class='smallworld_addschool' href='javascript:void(0);' id='schoolAdd'>" . _SMALLWORLD_ADDMORE . '</a><br><br>';
        $GLOBALS['xoopsTpl']->append('school', $school);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_school', 'no');
    }

    //Jobs
    //function job ($class, $name,$name2, $rel, array$options, $textmore, $selected=null, $preset=null, $selectedstart=null, $selectedstop=null) {
    if (0 != smallworldGetValfromArray('employment', 'smallworldusethesefields')) {
        $job = $item->job('smallworld_add4', 'job', 'job_type', '.smallworld_clone4', _SMALLWORLD_ADDMORE, $selected = null, $preset = null, $selectedstart = null, $selectedstop = null);
        $job .= "<span class='smallworld_remove3' id='jobremove'>";
        $job .= "<a href='javascript:void(0);' id='jobremovelnk'>" . _SMALLWORLD_REMOVE . '</a><br></span>';
        $job .= "<a class='smallworld_addjob' href='javascript:void(0);' id='jobAdd'>" . _SMALLWORLD_ADDMORE . '</a><br><br>';
        $GLOBALS['xoopsTpl']->append('job', $job);
    } else {
        $GLOBALS['xoopsTpl']->assign('show_jobs', 'no');
    }

    // Create hidden forms for birthcity
    $birthplace_lat         = $item->hidden('birthplace_lat', 'birthplace_lat', $preset = null);
    $birthplace_lng         = $item->hidden('birthplace_lng', 'birthplace_lng', $preset = null);
    $birthplace_country     = $item->hidden('birthplace_country', 'birthplace_country', $preset = null);
    $birthplace_country_img = $item->hidden('birthplace_country_img', 'birthplace_country_img', $preset = null);
    $GLOBALS['xoopsTpl']->append('birthplace_lat', $birthplace_lat);
    $GLOBALS['xoopsTpl']->append('birthplace_lng', $birthplace_lng);
    $GLOBALS['xoopsTpl']->append('birthplace_country', $birthplace_country);
    $GLOBALS['xoopsTpl']->append('birthplace_country_img', $birthplace_country_img);

    // Create hidden forms for present city
    $present_lat         = $item->hidden('present_lat', 'present_lat', $preset = null);
    $present_lng         = $item->hidden('present_lng', 'present_lng', $preset = null);
    $present_country_img = $item->hidden('present_country_img', 'present_country_img', $preset = null);
    //$present_country = $item->hidden('present_country','present_country',$preset=null);
    $GLOBALS['xoopsTpl']->append('present_lat', $present_lat);
    $GLOBALS['xoopsTpl']->append('present_lng', $present_lng);
    $GLOBALS['xoopsTpl']->append('present_country_img', $present_country_img);
    //$GLOBALS['xoopsTpl']->append('present_country',$present_country);

    $GLOBALS['xoopsTpl']->append('smallworld_register_title', _SMALLWORLD_REGRISTATION_TITLE);
    $GLOBALS['xoopsTpl']->assign('smallworld_beforesubmit', _SMALLWORLD_TEXTBEFORESUBMIT);
    $GLOBALS['xoopsTpl']->assign('smallworld_save', _SMALLWORLD_SUBMIT);
}

require_once XOOPS_ROOT_PATH . '/footer.php';
