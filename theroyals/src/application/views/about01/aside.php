<?php
/**
 * Created by PhpStorm.
 * User: amzad
 * Date: 23/06/14
 * Time: 00:12
 */ ?>
<!-- SIDEBAR -->
<aside id="sidebar">

    <ul>
        <? if ($side) { foreach ($side as $row){?>
        <li class="block">
            <h4 class="heading"><?=$row->title?></h4>
            <a href="<?=$row->image_href?>"><img src="<?=$row->image_src?>"  width="100%"/> </a>
        </li>
        <?}}?>
    </ul>

    <? /*
    <ul>
        <li class="block">
            <h4 class="heading">ARCHIVES</h4>
            <ul>
                <li class="cat-item"><a href="#">September 2012</a> (1)</li>
                <li class="cat-item"><a href="#">March 2012</a> (2)</li>
                <li class="cat-item"><a href="#">February 2012</a> (6)</li>
                <li class="cat-item"><a href="#">January 2012</a> (12)</li>
            </ul>
        </li>

        <li class="block">
            <h4 class="heading">POPULAR POSTS</h4>


            <div class="small-posts-list ">

                <div class="post cf">
                    <a href="#" class="thumb"><img src="img/dummies/54x54-a.jpg" alt="Post"></a>
                    <div class="post-head">
                        <a href="#">Pellentesque habitant morbi senectus </a><span class="meta"> Mar 12 <a href="#">By ansimuz</a></span>
                    </div>
                </div>

                <div class="post cf">
                    <a href="#" class="thumb"><img src="img/dummies/54x54-b.jpg" alt="Post"></a>
                    <div class="post-head">
                        <a href="#">Pellentesque habitant morbi senectus </a><span class="meta"> Mar 12 <a href="#">By ansimuz</a></span>
                    </div>
                </div>
data
                <div class="post cf">
                    <a href="#" class="thumb"><img src="img/dummies/54x54-c.jpg" alt="Post"></a>
                    <div class="post-head">
                        <a href="#">Pellentesque habitant morbi senectus </a><span class="meta"> Mar 12 <a href="#">By ansimuz</a></span>
                    </div>
                </div>
        </li>


        <li class="block">
            <h4 class="heading">SPONSORS</h4>
            <div class="ads cf">
                <a href="#"><img src="<?=$aboutIMG?>/dummies/banner-tf.gif" alt="Thumbnail"></a>
                <a href="#" class="last"><img src="<?=$aboutIMG?>/dummies/banner-mt.jpeg" alt="Thumbnail"></a>
                <a href="#"><img src="<?=$aboutIMG?>/dummies/banner-tp.jpeg" alt="Thumbnail"></a>
                <a href="#" class="last"><img src="<?=$aboutIMG?>/dummies/banner-tf.gif" alt="Thumbnail"></a>
            </div>
        </li>
    </ul>
    */?>

</aside>
<!-- ENDS SIDEBAR -->