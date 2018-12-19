<?php
// Author: http://www.fengziliu.com/

$smartideo = new smartideo();

class smartideo{
    private $edit = false;
    private $width = '100%';
    private $height = '100%';
    public function __construct(){
        wp_embed_unregister_handler('youku');
        wp_embed_unregister_handler('tudou');
        wp_embed_unregister_handler('56com');
        wp_embed_unregister_handler('youtube');
        
        // video
        wp_embed_register_handler( 'smartideo_tudou',
            '#https?://(?:www\.)?tudou\.com/(?:programs/view|listplay/(?<list_id>[a-z0-9_=\-]+))/(?<video_id>[a-z0-9_=\-]+)/#i',
            array($this, 'smartideo_embed_handler_tudou') );
        
        wp_embed_register_handler( 'smartideo_56',
            '#https?://(?:www\.)?56\.com/[a-z0-9]+/(?:play_album\-aid\-[0-9]+_vid\-(?<video_id1>[a-z0-9_=\-]+)|v_(?<video_id2>[a-z0-9_=\-]+))#i',
            array($this, 'smartideo_embed_handler_56') );
        
        wp_embed_register_handler( 'smartideo_youku',
            '#https?://v\.youku\.com/v_show/id_(?<video_id>[a-z0-9_=\-]+)#i',
            array($this, 'smartideo_embed_handler_youku') );
        
        wp_embed_register_handler( 'smartideo_qq',
            '#https?://v\.qq\.com/(?:[a-z0-9_\./]+\?vid=(?<video_id1>[a-z0-9_=\-]+)|(?:[a-z0-9/]+)/(?<video_id2>[a-z0-9_=\-]+))#i',
            array($this, 'smartideo_embed_handler_qq') );
        
        wp_embed_register_handler( 'smartideo_sohu',
            '#https?://my\.tv\.sohu\.com/(?:pl|us)/(?:\d+)/(?<video_id>\d+)#i',
            array($this, 'smartideo_embed_handler_sohu') );
        
        wp_embed_register_handler( 'smartideo_wasu',
            '#https?://www\.wasu\.cn/play/show/id/(?<video_id>\d+)#i',
            array($this, 'smartideo_embed_handler_wasu') );
        
        wp_embed_register_handler( 'smartideo_yinyuetai',
            '#https?://v\.yinyuetai\.com/video/(?<video_id>\d+)#i',
            array($this, 'smartideo_embed_handler_yinyuetai') );
        
        wp_embed_register_handler( 'smartideo_ku6',
            '#https?://v\.ku6\.com/show/(?<video_id>[a-z0-9\-_\.]+).html#i',
            array($this, 'smartideo_embed_handler_ku6') );
        
        wp_embed_register_handler( 'smartideo_letv',
            '#https?://(?:[a-z0-9/]+\.)?letv\.com/(?:[a-z0-9/]+)/(?<video_id>\d+)#i',
            array($this, 'smartideo_embed_handler_letv') );
        
        wp_embed_register_handler( 'smartideo_hunantv',
            '#https?://www\.hunantv\.com/(?:[a-z0-9/]+)/(?<video_id>\d+)\.html#i',
            array($this, 'smartideo_embed_handler_hunantv') );
        
        wp_embed_register_handler( 'smartideo_acfun',
            '#https?://www\.acfun\.tv/v/ac(?<video_id>\d+)#i',
            array($this, 'smartideo_embed_handler_acfun') );
        
        wp_embed_register_handler( 'smartideo_bilibili',
            '#https?://www\.bilibili\.com/video/av(?<video_id>\d+)#i',
            array($this, 'smartideo_embed_handler_bilibili') );
        
        wp_embed_register_handler( 'smartideo_youtube',
            '#https?://www\.youtube\.com/watch\?v=(?<video_id>\w+)#i',
            array($this, 'smartideo_embed_handler_youtube') );
        
        // music
        wp_embed_register_handler( 'smartideo_music163',
            '#https?://music\.163\.com/\#/song\?id=(?<video_id>\d+)#i',
            array($this, 'smartideo_embed_handler_music163') );
        
        wp_embed_register_handler( 'smartideo_xiami',
            '#https?://www\.xiami\.com/song/(?<video_id>\d+)#i',
            array($this, 'smartideo_embed_handler_xiami') );
        
    }
    
    # video
    public function smartideo_embed_handler_tudou( $matches, $attr, $url, $rawattr ) {
        $embed = $this->get_iframe("//www.tudou.com/programs/view/html5embed.action?type=0&code={$matches['video_id']}", $url);
        return apply_filters( 'embed_tudou', $embed, $matches, $attr, $url, $rawattr );
    }
    
    public function smartideo_embed_handler_56( $matches, $attr, $url, $rawattr ) {
	$matches['video_id'] = $matches['video_id1'] == '' ? $matches['video_id2'] : $matches['video_id1'];
        $embed = $this->get_iframe("//www.56.com/iframe/{$matches['video_id']}", $url);
        return apply_filters( 'embed_56', $embed, $matches, $attr, $url, $rawattr );
    }
    
    public function smartideo_embed_handler_youku( $matches, $attr, $url, $rawattr ) {
        $embed = $this->get_iframe("//player.youku.com/embed/{$matches['video_id']}", $url);
        return apply_filters( 'embed_youku', $embed, $matches, $attr, $url, $rawattr );
    }
    
    public function smartideo_embed_handler_qq( $matches, $attr, $url, $rawattr ) {
        $matches['video_id'] = $matches['video_id1'] == '' ? $matches['video_id2'] : $matches['video_id1'];
        $embed = $this->get_iframe("//v.qq.com/iframe/player.html?vid={$matches['video_id']}&tiny=0&auto=0", $url);
        return apply_filters( 'embed_qq', $embed, $matches, $attr, $url, $rawattr );
    }
    
    public function smartideo_embed_handler_sohu( $matches, $attr, $url, $rawattr ) {
        $embed = $this->get_iframe("//tv.sohu.com/upload/static/share/share_play.html#{$matches['video_id']}_0_0_9001_0", $url);
        return apply_filters( 'embed_sohu', $embed, $matches, $attr, $url, $rawattr );
    }
    
    public function smartideo_embed_handler_wasu( $matches, $attr, $url, $rawattr ) {
        $embed = $this->get_iframe("//www.wasu.cn/Play/iframe/id/{$matches['video_id']}", $url);
        return apply_filters( 'embed_wasu', $embed, $matches, $attr, $url, $rawattr );
    }
    
    public function smartideo_embed_handler_acfun( $matches, $attr, $url, $rawattr ) {
        $embed = $this->get_iframe("//ssl.acfun.tv/block-player-homura.html#vid={$matches['video_id']};from=http://www.acfun.tv", $url);
        return apply_filters( 'embed_acfun', $embed, $matches, $attr, $url, $rawattr );
    }
    
    public function smartideo_embed_handler_youtube( $matches, $attr, $url, $rawattr ) {
        $embed = $this->get_iframe("//www.youtube.com/embed/{$matches['video_id']}", $url);
        return apply_filters( 'embed_youtube', $embed, $matches, $attr, $url, $rawattr );
    }
    
    # video widthout h5
    public function smartideo_embed_handler_yinyuetai( $matches, $attr, $url, $rawattr ){
        $embed = $this->get_embed("http://player.yinyuetai.com/video/player/{$matches['video_id']}/v_0.swf", $url);
        return apply_filters( 'embed_yinyuetai', $embed, $matches, $attr, $url, $rawattr );
    }
    
    public function smartideo_embed_handler_ku6( $matches, $attr, $url, $rawattr ){
        $embed = $this->get_embed("//player.ku6.com/refer/{$matches['video_id']}/v.swf", $url);
        return apply_filters( 'embed_ku6', $embed, $matches, $attr, $url, $rawattr );
    }
    
    public function smartideo_embed_handler_letv($matches, $attr, $url, $rawattr){
        $embed = $this->get_embed("//i7.imgs.letv.com/player/swfPlayer.swf?id={$matches['video_id']}&autoplay=0", $url);
        return apply_filters( 'embed_letv', $embed, $matches, $attr, $url, $rawattr );
    }
    
    public function smartideo_embed_handler_hunantv( $matches, $attr, $url, $rawattr ) {
        $embed = $this->get_embed("//i1.hunantv.com/ui/swf/share/player.swf?video_id={$matches['video_id']}&autoplay=0", $url);
        return apply_filters( 'embed_hunantv', $embed, $matches, $attr, $url, $rawattr );
    }
    
    public function smartideo_embed_handler_bilibili( $matches, $attr, $url, $rawattr ) {
        if($this->is_https()){
            $embed = $this->get_embed("//static-s.bilibili.com/miniloader.swf?aid={$matches['video_id']}&page=1", $url);
        }else{
            $embed = $this->get_embed("//static.hdslb.com/miniloader.swf?aid={$matches['video_id']}&page=1", $url);
        }
        return apply_filters( 'embed_bilibili', $embed, $matches, $attr, $url, $rawattr );
    }
    
    # music
    public function smartideo_embed_handler_music163( $matches, $attr, $url, $rawattr ) {
        $embed = $this->get_iframe("//music.163.com/outchain/player?type=2&id={$matches['video_id']}&auto=0&height=90", '', '100%', '110px');
        return apply_filters( 'embed_music163', $embed, $matches, $attr, $url, $rawattr );
    }
    
    public function smartideo_embed_handler_xiami( $matches, $attr, $url, $rawattr ) {
        $embed = 
            '<div id="smartideo" style="background: transparent;">
                <script src="//www.xiami.com/widget/player-single?uid=0&sid='.$matches['video_id'].'&autoplay=0&mode=js" type="text/javascript"></script>
            </div>';
        return apply_filters( 'embed_music163', $embed, $matches, $attr, $url, $rawattr );
    }
    
    private function get_embed($url = '', $source = '', $width = '', $height = ''){
        $style = $html = '';
        if($this->edit){
            $width = $this->width;
            $height = $this->height;
        }
        if(!empty($width)){
            $style .= "width: {$width};";
        }
        if(!empty($height)){
            $style .= "height: {$height};";
        }
        if(!empty($style)){
            $style = ' style="' . $style . '"';
        }
        $html .= 
            '<div id="smartideo">
                <div class="player">
                    <embed src="' . $url . '" allowFullScreen="true" quality="high" width="100%" height="100%" allowScriptAccess="always" type="application/x-shockwave-flash" wmode="transparent"></embed>
                </div>';
        $html .= '</div>';
        return $html;
    }

    private function get_iframe($url = '', $source = '', $width = '', $height = ''){
        $style = $html = '';
        if($this->strategy == 1){
            $html .= sprintf('<link rel="stylesheet" id="smartideo-cssdd" href="%1$s" type="text/css" media="screen">', SMARTIDEO_URL . '/static/smartideo.css?ver=' . SMARTIDEO_VERSION);
        }
        if($this->edit){
            $width = $this->width;
            $height = $this->height;
        }
        if(!empty($width)){
            $style .= "width: {$width};";
        }
        if(!empty($height)){
            $style .= "height: {$height};";
        }
        if(!empty($style)){
            $style = ' style="' . $style . '"';
        }
        $html .= 
            '<div id="smartideo">
                <div class="player">
                    <iframe src="' . $url . '" width="100%" height="100%" frameborder="0" allowfullscreen="true"></iframe>
                </div>';
        $html .= '</div>';
        return $html;
    }


    private function is_https(){
        if($_SERVER['HTTPS'] == 'on'){
            return true;
        }else{
            return false;
        }
    }
}
