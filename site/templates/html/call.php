<div style="left: -20px;" id="coccoc-alo-phoneIcon" class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show">
    <div class="coccoc-alo-ph-circle"></div>
    <div class="coccoc-alo-ph-circle-fill"></div>
    <div class="coccoc-alo-ph-img-circle"><a href="tel:0972595693"><img alt="" src="<?=base_url()?>templates/images/phone-bottom-right.png"></a></div>
</div>


<style>
    #coccoc-alo-phoneIcon {display:none}
    
/*-----Media 616px-----*/
@media screen and (max-width:616px) {
    #coccoc-alo-phoneIcon {display:block}
    .coccoc-alo-phone.coccoc-alo-show {
    visibility: visible;
}

.coccoc-alo-phone {
    background-color: transparent;
    height: 200px;
    position: fixed;
    transition: visibility 0.5s ease 0s;
    visibility: hidden;
    width: 200px;
    z-index: 200000 !important;
    bottom: -10px;
}
.coccoc-alo-phone.coccoc-alo-green .coccoc-alo-ph-circle {
    border-color: #bfebfc;
    opacity: 0.5;
}

.coccoc-alo-ph-circle {
    animation: 1.2s ease-in-out 0s normal none infinite running coccoc-alo-circle-anim;
    background-color: transparent;
    border: 2px solid rgba(30, 30, 30, 0.4);
    border-radius: 100%;
    height: 160px;
    left: 20px;
    opacity: 0.1;
    position: absolute;
    top: 20px;
    transform-origin: 50% 50% 0;
    transition: all 0.5s ease 0s;
    width: 160px;
}

.coccoc-alo-phone.coccoc-alo-green .coccoc-alo-ph-circle-fill {
    background-color: rgba(0, 175, 242, 0.5);
    opacity: 0.75 !important;
}

.coccoc-alo-ph-circle-fill {
    animation: 2.3s ease-in-out 0s normal none infinite running coccoc-alo-circle-fill-anim;
    background-color: #000;
    border: 2px solid transparent;
    border-radius: 100%;
    height: 100px;
    left: 50px;
    opacity: 0.1;
    position: absolute;
    top: 50px;
    transform-origin: 50% 50% 0;
    transition: all 0.5s ease 0s;
    width: 100px;
}

.coccoc-alo-phone.coccoc-alo-green .coccoc-alo-ph-img-circle {
    background-color: #f06e00;
}
.coccoc-alo-ph-img-circle {
    animation: 1s ease-in-out 0s normal none infinite running coccoc-alo-circle-img-anim;
    border: 2px solid transparent;
    border-radius: 100%;
    height: 60px;
    left: 70px;
    opacity: 0.7;
    position: absolute;
    top: 70px;
    transform-origin: 50% 50% 0;
    width: 60px;
}
.coccoc-alo-ph-img-circle a img {
    padding: 4px 0 0 3px;}


@keyframes coccoc-alo-circle-anim {
 0% {
 opacity: 0.1;
 transform: rotate(0deg) scale(0.5) skew(1deg);
}
 30% {
 opacity: 0.5;
 transform: rotate(0deg) scale(0.7) skew(1deg);
}
 100% {
 opacity: 0.6;
 transform: rotate(0deg) scale(1) skew(1deg);
}

}


@keyframes coccoc-alo-circle-img-anim {
 0% {
 transform: rotate(0deg) scale(1) skew(1deg);
}
 10% {
 transform: rotate(-25deg) scale(1) skew(1deg);
}
 20% {
 transform: rotate(25deg) scale(1) skew(1deg);
}
 30% {
 transform: rotate(-25deg) scale(1) skew(1deg);
}
 40% {
 transform: rotate(25deg) scale(1) skew(1deg);
}
 50% {
 transform: rotate(0deg) scale(1) skew(1deg);
}
 100% {
 transform: rotate(0deg) scale(1) skew(1deg);
}
}
 @keyframes coccoc-alo-circle-fill-anim {
 0% {
 opacity: 0.2;
 transform: rotate(0deg) scale(0.7) skew(1deg);
}
 50% {
 opacity: 0.2;
 transform: rotate(0deg) scale(1) skew(1deg);
}
 100% {
 opacity: 0.2;
 transform: rotate(0deg) scale(0.7) skew(1deg);
}
 }
    
}    
    
    
    </style>