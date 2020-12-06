<{section name=i loop=$comments}>
<div class="smallworld_stcommentbody" id="smallworld_stcommentbody<{$comments[i].com_id}>">
    <div class="smallworld_stcommentimg">
        <img src="<{$comments[i].avatar_link}>" class='smallworld_small_face' <{$comments[i].avatar_highwide}>>
    </div>
    <div class="smallworld_stcommenttext">
        <{if $isadminuser == 'YES' or $post.username == $myusername}>
        <a class="smallworld_stcommentdelete" href="#" rel="<{$comments[i].uid}>" id='<{$comments[i].com_id}>' title='<{$smarty.const._SMALLWORLD_DELETECOMMENT}>'>X</a>
        <{/if}>
        <div class="comm_holder">
            <a class="smallworld_wall_link" href="<{$xoops_url}>/modules/smallworld/userprofile.php?username=<{$comments[i].username}>">
                <b><{$comments[i].username}></b>
            </a> <{$comments[i].comment}>
        </div>
        <div class="smallworld_stcommenttime"><{$comments[i].time}></div>
        <{if $comments[i].username == $myusername}>
        <div class="smallworld_stcommentvote">
            <span id="smallworld_votenum"><{$comments[i].vote_up}></span>
            <img class="smallworld_voteimg" src="assets/images/like.png">


            <span id="smallworld_votenum"><{$comments[i].vote_down}></span>
            <img class="smallworld_voteimg" src="assets/images/dislike.png">
        </div>
        <{else}>
        <div class="smallworld_stcommentvote">
            <span id="smallworld_votenum"><{$comments[i].vote_up}></span> <a href="javascript:void(0)" name="up" owner="<{$comm[i].uid}>" class="smallworld_stcomment_vote" id="<{$comments[i].com_id}>" type="com" type2="<{$comments[i].msg_id_fk}>">
            <img class="smallworld_voteimg" src="assets/images/like.png">
        </a>

            <span id="smallworld_votenum"><{$comments[i].vote_down}></span> <a href="javascript:void(0)" owner="<{$comm[i].uid}>" name="down" class="smallworld_stcomment_vote" id="<{$comments[i].com_id}>" type="com" type2="<{$comments[i].msg_id_fk}>">
            <img class="smallworld_voteimg" src="assets/images/dislike.png">
        </a>
            <a href="javascript:void(0)" by_user="<{$myusername}>" a_user="<{$comm[i].username}>" name="complaint" class="smallworld_comment_complaint" id="<{$comm[i].compl_msg_lnk}>">
                <img class="smallworld_voteimg" src="assets/images/complaint.png">
            </a>
        </div>
        <{/if}>
    </div>
    <{/section}>
    <script type="text/javascript">
        xoops_smallworld(document).ready(function () {
            smallworldCheckNumDivs();
            Smallworld_attachAvatarOpen();
        });
    </script>
