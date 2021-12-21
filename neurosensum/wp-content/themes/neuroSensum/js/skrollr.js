(function(window,document,undefined){'use strict';var skrollr=window.skrollr={get:function(){return _instance;},init:function(options){return _instance||new Skrollr(options);},VERSION:'0.5.10'};var hasProp=Object.prototype.hasOwnProperty;var documentElement;var body;var RENDERED_CLASS='rendered';var UNRENDERED_CLASS='un'+RENDERED_CLASS;var SKROLLABLE_CLASS='skrollable';var SKROLLR_CLASS='skrollr';var NO_SKROLLR_CLASS='no-'+SKROLLR_CLASS;var DEFAULT_EASING='linear';var DEFAULT_DURATION=1000;var SMOOTH_SCROLLING_DURATION=200;var ANCHOR_START='start';var ANCHOR_END='end';var ANCHOR_TOP='top';var ANCHOR_CENTER='center';var ANCHOR_BOTTOM='bottom';var SKROLLABLE_HAS_RENDERED_CLASS_PROPERTY='___has_rendered_class';var SKROLLABLE_ID_DOM_PROPERTY='___skrollable_id';var requestAnimFrame=window.requestAnimationFrame;(function(){var vendors=['ms','moz','webkit','o'];var i;for(i=0;i<vendors.length&&!requestAnimFrame;i++){requestAnimFrame=window[vendors[i]+'RequestAnimationFrame'];}var lastTime=0;if(!requestAnimFrame){requestAnimFrame=function(callback){var currTime=_now();var timeToCall=Math.max(0,30-(currTime-lastTime));window.setTimeout(function(){callback(currTime+timeToCall);},timeToCall);lastTime=currTime+timeToCall;};}}());var rxTrim=/^\s*(.+)\s*$/m;var rxKeyframeAttribute=/^data(?:-(_\w+))?(?:-?(-?\d+))?(?:-?(start|end|top|center|bottom))?(?:-?(top|center|bottom))?$/;var rxPropValue=/\s*([a-z\-\[\]]+)\s*:\s*(.+?)\s*(?:;|$)/gi;var rxPropEasing=/^([a-z\-]+)\[(\w+)\]$/;var rxCamelCase=/-([a-z])/g;var rxCamelCaseFn=function(str,letter){return letter.toUpperCase();};var rxNumericValue=/[\-+]?[\d]*\.?[\d]+/g;var rxInterpolateString=/\{\?\}/g;var rxRGBAIntegerColor=/rgba?\(\s*-?\d+\s*,\s*-?\d+\s*,\s*-?\d+/g;var rxGradient=/[a-z\-]+-gradient/g;var theCSSPrefix;var theDashedCSSPrefix;var detectCSSPrefix=function(){var rxPrefixes=/^(?:O|Moz|webkit|ms)/;if(window.getComputedStyle){var style=window.getComputedStyle(body,null);for(var k in style){theCSSPrefix=(k.match(rxPrefixes)||(+k==k&&style[k].match(rxPrefixes)));if(theCSSPrefix){break;}}}theCSSPrefix=(theCSSPrefix||[''])[0];theDashedCSSPrefix='-'+theCSSPrefix.toLowerCase()+'-';};var easings={begin:function(){return 0;},end:function(){return 1;},linear:function(p){return p;},quadratic:function(p){return p*p;},cubic:function(p){return p*p*p;},swing:function(p){return(-Math.cos(p*Math.PI)/2)+0.5;},sqrt:function(p){return Math.sqrt(p);},bounce:function(p){var a;if(p<=0.5083){a=3;}else if(p<=0.8489){a=9;}else if(p<=0.96208){a=27;}else if(p<=0.99981){a=91;}else{return 1;}return 1-Math.abs(3*Math.cos(p*a*1.028)/a);}};function Skrollr(options){documentElement=document.documentElement;body=document.body;detectCSSPrefix();_instance=this;options=options||{};_constants=options.constants||{};if(options.easing){for(var e in options.easing){easings[e]=options.easing[e];}}_listeners={beforerender:options.beforerender,render:options.render};_forceHeight=options.forceHeight!==false;_smoothScrollingEnabled=options.smoothScrolling!==false;_smoothScrolling={targetTop:_instance.getScrollTop()};if(_forceHeight){_scale=options.scale||1;}_updateClass(documentElement,[SKROLLR_CLASS],[NO_SKROLLR_CLASS]);if(_forceHeight){var dummy=document.getElementById('skrollr-body')||document.createElement('div');var dummyStyle=dummy.style;dummyStyle.minWidth='1px';dummyStyle.position='absolute';dummyStyle.top=dummyStyle.zIndex='0';if(!dummy.id){dummyStyle.width='1px';dummyStyle.right='0';body.appendChild(dummy);}_reflow=function(){_maxKeyFrame=0;_updateDependentKeyFrames();dummyStyle.height=(_maxKeyFrame+documentElement.clientHeight)+'px';if(skrollr.iscroll){window.setTimeout(function(){skrollr.iscroll.refresh();},0);}};}else{_reflow=function(){_maxKeyFrame=body.scrollHeight-documentElement.clientHeight;_updateDependentKeyFrames();_forceRender=true;if(skrollr.iscroll){window.setTimeout(function(){skrollr.iscroll.refresh();},0);}};}_instance.refresh();_addEvent('resize',_reflow);(function animloop(){requestAnimFrame(animloop);_render();}());return _instance;}Skrollr.prototype.refresh=function(elements){var elementIndex;var ignoreID=false;if(elements===undefined){ignoreID=true;_skrollables=[];_skrollableIdCounter=0;elements=document.getElementsByTagName('*');}else{elements=[].concat(elements);}for(elementIndex=0;elementIndex<elements.length;elementIndex++){var el=elements[elementIndex];var anchorTarget=el;var keyFrames=[];var smoothScrollThis=_smoothScrollingEnabled;if(!el.attributes){continue;}for(var attributeIndex=0;attributeIndex<el.attributes.length;attributeIndex++){var attr=el.attributes[attributeIndex];if(attr.name==='data-anchor-target'){anchorTarget=document.querySelector(attr.value);if(anchorTarget===null){throw'Unable to find anchor target "'+attr.value+'"';}continue;}if(attr.name==='data-smooth-scrolling'){smoothScrollThis=attr.value!=='off';continue;}var match=attr.name.match(rxKeyframeAttribute);if(match!==null){var constant=match[1];constant=constant&&_constants[constant.substr(1)]||0;var offset=(match[2]|0)+constant;var anchor1=match[3];var anchor2=match[4]||anchor1;var kf={offset:offset,props:attr.value,element:el};keyFrames.push(kf);if(!anchor1||anchor1===ANCHOR_START||anchor1===ANCHOR_END){kf.mode='absolute';if(anchor1===ANCHOR_END){kf.isEnd=true;}else{kf.frame=offset*_scale;delete kf.offset;}}else{kf.mode='relative';kf.anchors=[anchor1,anchor2];}}}if(keyFrames.length){var styleAttr,classAttr;var id;if(!ignoreID&&SKROLLABLE_ID_DOM_PROPERTY in el){id=el[SKROLLABLE_ID_DOM_PROPERTY];styleAttr=_skrollables[id].styleAttr;classAttr=_skrollables[id].classAttr;}else{id=(el[SKROLLABLE_ID_DOM_PROPERTY]=_skrollableIdCounter++);styleAttr=el.style.cssText;classAttr=_getClass(el);}var skrollable=_skrollables[id]={element:el,styleAttr:styleAttr,classAttr:classAttr,anchorTarget:anchorTarget,keyFrames:keyFrames,smoothScrolling:smoothScrollThis};_updateClass(el,[SKROLLABLE_CLASS,RENDERED_CLASS],[UNRENDERED_CLASS]);skrollable[SKROLLABLE_HAS_RENDERED_CLASS_PROPERTY]=true;}}_reflow();for(elementIndex=0;elementIndex<elements.length;elementIndex++){var sk=_skrollables[elements[elementIndex][SKROLLABLE_ID_DOM_PROPERTY]];if(sk===undefined){continue;}sk.keyFrames.sort(_keyFrameComparator);_parseProps(sk);_fillProps(sk);}return _instance;};Skrollr.prototype.relativeToAbsolute=function(element,viewportAnchor,elementAnchor){var viewportHeight=documentElement.clientHeight;var box=element.getBoundingClientRect();var absolute=box.top;var boxHeight=box.bottom-box.top;if(viewportAnchor===ANCHOR_BOTTOM){absolute-=viewportHeight;}else if(viewportAnchor===ANCHOR_CENTER){absolute-=viewportHeight/2;}if(elementAnchor===ANCHOR_BOTTOM){absolute+=boxHeight;}else if(elementAnchor===ANCHOR_CENTER){absolute+=boxHeight/2;}absolute+=_instance.getScrollTop();return(absolute+0.5)|0;};Skrollr.prototype.animateTo=function(top,options){options=options||{};var now=_now();var scrollTop=_instance.getScrollTop();_scrollAnimation={startTop:scrollTop,topDiff:top-scrollTop,targetTop:top,duration:options.duration||DEFAULT_DURATION,startTime:now,endTime:now+(options.duration||DEFAULT_DURATION),easing:easings[options.easing||DEFAULT_EASING],done:options.done};if(!_scrollAnimation.topDiff){if(_scrollAnimation.done){_scrollAnimation.done.call(_instance,false);}_scrollAnimation=undefined;}return _instance;};Skrollr.prototype.stopAnimateTo=function(){if(_scrollAnimation&&_scrollAnimation.done){_scrollAnimation.done.call(_instance,true);}_scrollAnimation=undefined;};Skrollr.prototype.isAnimatingTo=function(){return!!_scrollAnimation;};Skrollr.prototype.setScrollTop=function(top){if(skrollr.iscroll){skrollr.iscroll.scrollTo(0,-top);}else{window.scrollTo(0,top);}return _instance;};Skrollr.prototype.getScrollTop=function(){if(skrollr.iscroll){return-skrollr.iscroll.y;}else{return window.pageYOffset||documentElement.scrollTop||body.scrollTop||0;}};Skrollr.prototype.on=function(name,fn){_listeners[name]=fn;return _instance;};Skrollr.prototype.off=function(name){delete _listeners[name];return _instance;};var _updateDependentKeyFrames=function(){var skrollable;var element;var anchorTarget;var keyFrames;var kf;var skrollableIndex;var keyFrameIndex;var styleAttr;var classAttr;for(skrollableIndex=0;skrollableIndex<_skrollables.length;skrollableIndex++){skrollable=_skrollables[skrollableIndex];element=skrollable.element;anchorTarget=skrollable.anchorTarget;keyFrames=skrollable.keyFrames;for(keyFrameIndex=0;keyFrameIndex<keyFrames.length;keyFrameIndex++){kf=keyFrames[keyFrameIndex];if(kf.mode==='relative'){styleAttr=element.style.cssText;classAttr=_getClass(element);element.style.cssText=skrollable.styleAttr;_updateClass(element,skrollable.classAttr);kf.frame=_instance.relativeToAbsolute(anchorTarget,kf.anchors[0],kf.anchors[1])-kf.offset;element.style.cssText=styleAttr;_updateClass(element,classAttr);}if(_forceHeight){if(!kf.isEnd&&kf.frame>_maxKeyFrame){_maxKeyFrame=kf.frame;}}}}for(skrollableIndex=0;skrollableIndex<_skrollables.length;skrollableIndex++){skrollable=_skrollables[skrollableIndex];keyFrames=skrollable.keyFrames;for(keyFrameIndex=0;keyFrameIndex<keyFrames.length;keyFrameIndex++){kf=keyFrames[keyFrameIndex];if(kf.isEnd){kf.frame=_maxKeyFrame-kf.offset;}}}};var _calcSteps=function(fakeFrame,actualFrame){for(var skrollableIndex=0;skrollableIndex<_skrollables.length;skrollableIndex++){var skrollable=_skrollables[skrollableIndex];var frame=skrollable.smoothScrolling?fakeFrame:actualFrame;var frames=skrollable.keyFrames;var firstFrame=frames[0].frame;var lastFrame=frames[frames.length-1].frame;var atFirst=frame<=firstFrame;var atLast=frame>=lastFrame;var key;var value;if(atFirst||atLast){var props=frames[atFirst?0:frames.length-1].props;for(key in props){if(hasProp.call(props,key)){value=_interpolateString(props[key].value);skrollr.setStyle(skrollable.element,key,value);}}if(skrollable[SKROLLABLE_HAS_RENDERED_CLASS_PROPERTY]&&(frame<firstFrame||frame>lastFrame)){_updateClass(skrollable.element,[UNRENDERED_CLASS],[RENDERED_CLASS]);skrollable[SKROLLABLE_HAS_RENDERED_CLASS_PROPERTY]=false;}continue;}if(!skrollable[SKROLLABLE_HAS_RENDERED_CLASS_PROPERTY]){_updateClass(skrollable.element,[RENDERED_CLASS],[UNRENDERED_CLASS]);skrollable[SKROLLABLE_HAS_RENDERED_CLASS_PROPERTY]=true;}for(var keyFrameIndex=0;keyFrameIndex<frames.length-1;keyFrameIndex++){if(frame>=frames[keyFrameIndex].frame&&frame<=frames[keyFrameIndex+1].frame){var left=frames[keyFrameIndex];var right=frames[keyFrameIndex+1];for(key in left.props){if(hasProp.call(left.props,key)){var progress=(frame-left.frame)/(right.frame-left.frame);progress=left.props[key].easing(progress);value=_calcInterpolation(left.props[key].value,right.props[key].value,progress);value=_interpolateString(value);skrollr.setStyle(skrollable.element,key,value);}}break;}}}};var _render=function(){var renderTop=_instance.getScrollTop();var afterAnimationCallback;var now=_now();var progress;if(_scrollAnimation){if(now>=_scrollAnimation.endTime){renderTop=_scrollAnimation.targetTop;afterAnimationCallback=_scrollAnimation.done;_scrollAnimation=undefined;}else{progress=_scrollAnimation.easing((now-_scrollAnimation.startTime)/_scrollAnimation.duration);renderTop=(_scrollAnimation.startTop+progress*_scrollAnimation.topDiff)|0;}_instance.setScrollTop(renderTop);}else{var smoothScrollingDiff=_smoothScrolling.targetTop-renderTop;if(smoothScrollingDiff){_smoothScrolling={startTop:_lastTop,topDiff:renderTop-_lastTop,targetTop:renderTop,startTime:_lastRenderCall,endTime:_lastRenderCall+SMOOTH_SCROLLING_DURATION};}if(now<=_smoothScrolling.endTime){progress=easings.sqrt((now-_smoothScrolling.startTime)/SMOOTH_SCROLLING_DURATION);renderTop=(_smoothScrolling.startTop+progress*_smoothScrolling.topDiff)|0;}}if(renderTop<0){renderTop=0;}if(_forceRender||_lastTop!==renderTop){_direction=(renderTop>=_lastTop)?'down':'up';_forceRender=false;var listenerParams={curTop:renderTop,lastTop:_lastTop,maxTop:_maxKeyFrame,direction:_direction};var continueRendering=_listeners.beforerender&&_listeners.beforerender.call(_instance,listenerParams);if(continueRendering!==false){_calcSteps(renderTop,_instance.getScrollTop());_lastTop=renderTop;if(_listeners.render){_listeners.render.call(_instance,listenerParams);}}if(afterAnimationCallback){afterAnimationCallback.call(_instance,false);}}_lastRenderCall=now;};var _parseProps=function(skrollable){for(var keyFrameIndex=0;keyFrameIndex<skrollable.keyFrames.length;keyFrameIndex++){var frame=skrollable.keyFrames[keyFrameIndex];var easing;var value;var prop;var props={};var match;while((match=rxPropValue.exec(frame.props))!==null){prop=match[1];value=match[2];easing=prop.match(rxPropEasing);if(easing!==null){prop=easing[1];easing=easing[2];}else{easing=DEFAULT_EASING;}value=value.indexOf('!')?_parseProp(value):[value.slice(1)];props[prop]={value:value,easing:easings[easing]};}frame.props=props;}};var _parseProp=function(val){var numbers=[];rxRGBAIntegerColor.lastIndex=0;val=val.replace(rxRGBAIntegerColor,function(rgba){return rgba.replace(rxNumericValue,function(n){return n/255*100+'%';});});rxGradient.lastIndex=0;val=val.replace(rxGradient,function(s){return theDashedCSSPrefix+s;});val=val.replace(rxNumericValue,function(n){numbers.push(+n);return'{?}';});numbers.unshift(val);return numbers;};var _fillProps=function(sk){var propList={};var keyFrameIndex;for(keyFrameIndex=0;keyFrameIndex<sk.keyFrames.length;keyFrameIndex++){_fillPropForFrame(sk.keyFrames[keyFrameIndex],propList);}propList={};for(keyFrameIndex=sk.keyFrames.length-1;keyFrameIndex>=0;keyFrameIndex--){_fillPropForFrame(sk.keyFrames[keyFrameIndex],propList);}};var _fillPropForFrame=function(frame,propList){var key;for(key in propList){if(!hasProp.call(frame.props,key)){frame.props[key]=propList[key];}}for(key in frame.props){propList[key]=frame.props[key];}};var _calcInterpolation=function(val1,val2,progress){if(val1.length!==val2.length){throw'Can\'t interpolate between "'+val1[0]+'" and "'+val2[0]+'"';}var interpolated=[val1[0]];for(var valueIndex=1;valueIndex<val1.length;valueIndex++){interpolated[valueIndex]=val1[valueIndex]+((val2[valueIndex]-val1[valueIndex])*progress);}return interpolated;};var _interpolateString=function(val){var valueIndex=1;rxInterpolateString.lastIndex=0;return val[0].replace(rxInterpolateString,function(){return val[valueIndex++];});};skrollr.setStyle=function(el,prop,val){var style=el.style;prop=prop.replace(rxCamelCase,rxCamelCaseFn).replace('-','');if(prop==='zIndex'){style[prop]=''+(val|0);}else if(prop==='float'){style.styleFloat=style.cssFloat=val;}else{try{style[theCSSPrefix+prop.slice(0,1).toUpperCase()+prop.slice(1)]=val;style[prop]=val;}catch(ignore){}}};var _addEvent=function(name,fn){if(window.addEventListener){window.addEventListener(name,fn,false);}else{window.attachEvent('on'+name,fn);}};var _getClass=function(element){var prop='className';if(window.SVGElement&&element instanceof window.SVGElement){element=element[prop];prop='baseVal';}return element[prop];};var _updateClass=function(element,add,remove){var prop='className';if(window.SVGElement&&element instanceof window.SVGElement){element=element[prop];prop='baseVal';}if(remove===undefined){element[prop]=add;return;}var val=element[prop];for(var classAddIndex=0;classAddIndex<add.length;classAddIndex++){if(_untrim(val).indexOf(_untrim(add[classAddIndex]))===-1){val+=' '+add[classAddIndex];}}for(var classRemoveIndex=0;classRemoveIndex<remove.length;classRemoveIndex++){val=_untrim(val).replace(_untrim(remove[classRemoveIndex]),' ');}element[prop]=_trim(val);};var _trim=function(a){return a.replace(rxTrim,'$1');};var _untrim=function(a){return' '+a+' ';};var _now=Date.now||function(){return+new Date();};var _keyFrameComparator=function(a,b){return a.frame-b.frame;};var _instance;var _skrollables;var _listeners;var _forceHeight;var _maxKeyFrame=0;var _reflow;var _scale=1;var _constants;var _direction='down';var _lastTop=-1;var _lastRenderCall=_now();var _scrollAnimation;var _smoothScrollingEnabled;var _smoothScrolling;var _forceRender;var _skrollableIdCounter=0;}(window,document));