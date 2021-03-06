<{foreach item=post from=$walldata}>
<script type="text/javascript">
    xoops_smallworld(document).ready(function () {
        xoops_smallworld("#smallworld_stexpand<{$post.msg_id}>").oembed("<{$post.orimessage}>", {
            embedMethod: 'fill',
            maxWidth: "100%",
            maxHeight: "100%"
        });
    });
</script>
<div class="smallworld_stbody" id="smallworld_stbody<{$post.msg_id}>">
    <div class="smallworld_stimg">
        <img src="<{$post.avatar_link}>" class='smallworld_big_face' <{$post.avatar_highwide}>>
    </div>
    <div class="smallworld_sttext">
        <{if $isadminuser == 'YES' or $post.username == $myusername}>
        <a class="smallworld_stdelete" href="#" rel="<{$post.uid_fk}>" id="<{$post.msg_id}>" title="<{$smarty.const._SMALLWORLD_DELUPD}>">X</a>
        <{/if}>
        <a href="<{$post.permalink}>"> <img style="height:10px; width:10px" src="<{$post.linkimage}>"> </a>
        <b><a class="smallworld_wall_link" href="<{$xoops_url}>/modules/smallworld/userprofile.php?username=<{$post.username}>"><{$post.username}></a></b> <{$post.message}>
        <div class="smallworld_sttime"><{$post.created}><{$post.sharelink}> | <a href='#' class='smallworld_commentopen' id='<{$post.msg_id}>' title='<{$smarty.const._SMALLWORLD_COMMENTWALL}>'><{$smarty.const._SMALLWORLD_COMMENTWALL}></a></div>
        <{$post.sharediv}>
        <{if $post.username == $myusername}>
        <div class="smallworld_stcommentvote">
            <span id="smallworld_votenum"><{$post.vote_up}></span>
            <img class="smallworld_voteimg" src="assets/images/like.png">

            <span id="smallworld_votenum"><{$post.vote_down}></span>
            <img class="smallworld_voteimg" src="assets/images/dislike.png">

        </div>
        <{else}>
        <div class="smallworld_stcommentvote">
            <span id="smallworld_votenum"><{$post.vote_up}></span> <a href="javascript:void(0)" owner="<{$post.uid_fk}>" name="up" class="smallworld_stcomment_vote" id="<{$post.msg_id}>" type="msg">
            <img class="smallworld_voteimg" src="assets/images/like.png">
        </a>
            <span id="smallworld_votenum"><{$post.vote_down}></span> <a href="javascript:void(0)" owner="<{$post.uid_fk}>" name="down" class="smallworld_stcomment_vote" id="<{$post.msg_id}>" type="msg">
            <img class="smallworld_voteimg" src="assets/images/dislike.png">
        </a>
            <a href="javascript:void(0)" by_user="<{$myusername}>" a_user="<{$post.username}>" name="complaint" class="smallworld_comment_complaint" id="<{$post.compl_msg_lnk}>">
                <img class="smallworld_voteimg" src="assets/images/complaint.png">
            </a>
        </div>
        <{/if}>

        <div id="smallworld_stexpandbox">
            <div id="smallworld_stexpand<{$post.msg_id}>"></div>
        </div>

        <div class="smallworld_commentcontainer" id="smallworld_commentload<{$post.msg_id}>">
            <{section name=i loop=$comm}>
            <{if $comm[i].msg_id_fk == $post.msg_id}>
            <div class="smallworld_stcommentbody" id="smallworld_stcommentbody<{$comm[i].com_id}>">
                <div class="smallworld_stcommentimg">
                    <img src="<{$comm[i].avatar_link}>" class='smallworld_small_face' <{$comm[i].avatar_highwide}>>
                </div>
                <div class="smallworld_stcommenttext">
                    <{if $isadminuser == 'YES' or $comm[i].username == $myusername}>
                    <a class="smallworld_stcommentdelete" href="#" rel="<{$comm[i].uid}>" id='<{$comm[i].com_id}>' title='<{$smarty.const._SMALLWORLD_DELETECOMMENT}>'>X</a>
                    <{/if}>
                    <div class="comm_holder">
                        <a class="smallworld_wall_link" href="<{$xoops_url}>/modules/smallworld/userprofile.php?username=<{$comm[i].username}>">
                            <b><{$comm[i].username}></b>
                        </a> <{$comm[i].comment}>
                    </div>

                    <div class="smallworld_stcommenttime">
                        <{$comm[i].time}>
                    </div>
                    <{if $comm[i].username == $myusername}>
                    <div class="smallworld_stcommentvote">
                        <span id="smallworld_votenum"><{$comm[i].vote_up}></span>
                        <img class="smallworld_voteimg" src="assets/images/like.png">


                        <span id="smallworld_votenum"><{$comm[i].vote_down}></span>
                        <img class="smallworld_voteimg" src="assets/images/dislike.png">

                    </div>
                    <{else}>
                    <div class="smallworld_stcommentvote">
                        <span id="smallworld_votenum"><{$comm[i].vote_up}></span> <a href="javascript:void(0)" owner="<{$comm[i].uid}>" name="up" class="smallworld_stcomment_vote" id="<{$comm[i].com_id}>" type="com" type2="<{$comm[i].msg_id_fk}>">
                        <img class="smallworld_voteimg" src="assets/images/like.png">
                    </a>

                        <span id="smallworld_votenum"><{$comm[i].vote_down}></span> <a href="javascript:void(0)" owner="<{$comm[i].uid}>" name="down" class="smallworld_stcomment_vote" id="<{$comm[i].com_id}>" type="com" type2="<{$comm[i].msg_id_fk}>">
                        <img class="smallworld_voteimg" src="assets/images/dislike.png">
                    </a>
                        <a href="javascript:void(0)" by_user="<{$myusername}>" a_user="<{$comm[i].username}>" name="complaint" class="smallworld_comment_complaint" id="<{$comm[i].compl_msg_lnk}>">
                            <img class="smallworld_voteimg" src="assets/images/complaint.png">
                        </a>
                    </div>
                    <{/if}>
                </div>
            </div>
            <{/if}>
            <{/section}>
        </div> <!-- smallworld_commentcontainer -->
        <div class="smallworld_commentupdate" style='display:none' id='smallworld_commentbox<{$post.msg_id}>'>
            <div class="smallworld_stcommentimg">
                <img src="<{$myavatarlink}>" class='smallworld_small_face' <{$myavatar_highwide}>>
            </div>
            <div class="smallworld_stcommenttext">
                <form method="post" action="">
                    <textarea name="smallworld_comment" class="smallworld_comment" id="smallworld_ctextarea<{$post.msg_id}>"></textarea>
                    <br>
                    <input type="submit" value="<{$smarty.const._SMALLWORLD_COMMENTBUTTONTEXT}>" id="<{$post.msg_id}>" class="smallworld_comment_button">
                </form>
            </div>
        </div> <!-- smallworld_commentupdate -->
    </div> <!-- smallworld_sttext -->
</div> <!-- smallworld_stbody -->
<{/foreach}>

<div id="smallworld_moremsg_ajax" style="display:none">
    <img src="assets/images/loader.gif">
</div>

<{if $sCountResp >= $msgtoshow}>
<a href="javascript:void(0)" class="smallworld_msg_counter" rel="<{$pagename}>" id="<{$post.msg_id}>"><{$smarty.const._SMALLWORLD_MOREBUTTONLINK}></a>
<{/if}>

<script type="text/javascript">
    xoops_smallworld(document).ready(function () {
        smallworldCheckNumDivs();
        Smallworld_attachAvatarOpen();
        SmallworldGetMoreMsg();
    });
</script>
