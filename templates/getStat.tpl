<script type="text/javascript" src="assets/js/jquery.innerfade.js"></script>
<ul id="smallworld_stats_scroller">
    <li>
        <span id="smallworld_Stats_title"><{$smarty.const._SMALLWORLD_STATS_NEWESTUSERS}></span>
        <{foreach item=nu from=$newusers}>
        <span id="smallworld_stats_img"><img src="<{$nu.userimage_link}>" height="30px" width="30px"></span>
        <span id="smallworld_stats_text"><{$nu.username_link}></span>
        <{/foreach}>
    </li>
    <li>
        <span id="smallworld_Stats_title"><{$smarty.const._SMALLWORLD_STATS_MOSTACTUSERS}></span>
        <{foreach item=mau from=$mostactiveU}>
        <span id="smallworld_stats_img"><img src="<{$mau.img}>" height="30px" width="30px"></span>
        <span id="smallworld_stats_text"><{$mau.username_link}></span>
        <{/foreach}>
    </li>

    <li>
        <span id="smallworld_Stats_title"><{$smarty.const._SMALLWORLD_STATS_BESTRATEDUSERS}></span>
        <{foreach item=bru from=$bestratedU}>
        <span id="smallworld_stats_img"><img src="<{$bru.img}>" height="30px" width="30px"></span>
        <span id="smallworld_stats_text"><{$bru.user_link}> </span>
        <{/foreach}>
    </li>

    <li>
        <span id="smallworld_Stats_title"><{$smarty.const._SMALLWORLD_STATS_WORSTRATEDUSERS}></span>
        <{foreach item=wru from=$worstratedU}>
        <span id="smallworld_stats_img"><img src="<{$wru.img}>" height="30px" width="30px"></span>
        <span id="smallworld_stats_text"><{$wru.user_link}> </span>
        <{/foreach}>
    </li>

    <{foreach item=bu from=$birthdays}>
    <{if $birthdays != 0}>
    <li>
        <span id="smallworld_Stats_title"><{$smarty.const._SMALLWORLD_STATS_BDAYSTODAY}></span>
        <span id="smallworld_stats_img"><img src="<{$bu.userimage}>" height="30px" width="30px"></span>
        <span id="smallworld_stats_text"><{$bu.username_link}></span>
    </li>
    <{else}>
    <li>
        <span id="smallworld_stats_text_nobdays"><{$smarty.const._SMALLWORLD_STATS_NOBDAYSTODAY}></span>
    </li>
    <{/if}>
    <{/foreach}>
    <{foreach item=sp from=$sp}>
    <li>
        <span id="smallworld_Stats_title"><{$smarty.const._SMALLWORLD_STATS_LIKETHISMODULE}></span>
        <span id="smallworld_stats_img"><{$sp.spimage}></span>
        <span id="smallworld_stats_text"><a id="smallworldDonate" href='javascript:void(0);'><{$smarty.const._SMALLWORLD_DONATETEXT}></a></span>
    </li>
    <{/foreach}>
</ul>
<script type="text/javascript">
    jQuery(function () {
        jQuery('#smallworld_stats_scroller').innerfade({
            animationtype: 'fade',
            speed: 1200,
            timeout: 5000,
            type: 'sequence',
            containerheight: '50px'
        });
    });
</script>
