
<!DOCTYPE html>
<html>
  
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="UTF-8">
<script>window.NREUM||(NREUM={});NREUM.info={"beacon":"bam.nr-data.net","errorBeacon":"bam.nr-data.net","licenseKey":"0dd6621354","applicationID":"25510693","transactionName":"d15eEEpfDllSQExWQUQeVwFMbxFBVkAXUlUbQlgLTw==","queueTime":9,"applicationTime":151,"agent":""}</script>
<script>(window.NREUM||(NREUM={})).loader_config={xpid:"UwYOWVBbGwEFUVBSAQgE"};window.NREUM||(NREUM={}),__nr_require=function(t,e,n){function r(n){if(!e[n]){var o=e[n]={exports:{}};t[n][0].call(o.exports,function(e){var o=t[n][1][e];return r(o||e)},o,o.exports)}return e[n].exports}if("function"==typeof __nr_require)return __nr_require;for(var o=0;o<n.length;o++)r(n[o]);return r}({1:[function(t,e,n){function r(t){try{s.console&&console.log(t)}catch(e){}}var o,i=t("ee"),a=t(21),s={};try{o=localStorage.getItem("__nr_flags").split(","),console&&"function"==typeof console.log&&(s.console=!0,o.indexOf("dev")!==-1&&(s.dev=!0),o.indexOf("nr_dev")!==-1&&(s.nrDev=!0))}catch(c){}s.nrDev&&i.on("internal-error",function(t){r(t.stack)}),s.dev&&i.on("fn-err",function(t,e,n){r(n.stack)}),s.dev&&(r("NR AGENT IN DEVELOPMENT MODE"),r("flags: "+a(s,function(t,e){return t}).join(", ")))},{}],2:[function(t,e,n){function r(t,e,n,r,s){try{l?l-=1:o(s||new UncaughtException(t,e,n),!0)}catch(f){try{i("ierr",[f,c.now(),!0])}catch(d){}}return"function"==typeof u&&u.apply(this,a(arguments))}function UncaughtException(t,e,n){this.message=t||"Uncaught error with no additional information",this.sourceURL=e,this.line=n}function o(t,e){var n=e?null:c.now();i("err",[t,n])}var i=t("handle"),a=t(22),s=t("ee"),c=t("loader"),f=t("gos"),u=window.onerror,d=!1,p="nr@seenError",l=0;c.features.err=!0,t(1),window.onerror=r;try{throw new Error}catch(h){"stack"in h&&(t(13),t(12),"addEventListener"in window&&t(6),c.xhrWrappable&&t(14),d=!0)}s.on("fn-start",function(t,e,n){d&&(l+=1)}),s.on("fn-err",function(t,e,n){d&&!n[p]&&(f(n,p,function(){return!0}),this.thrown=!0,o(n))}),s.on("fn-end",function(){d&&!this.thrown&&l>0&&(l-=1)}),s.on("internal-error",function(t){i("ierr",[t,c.now(),!0])})},{}],3:[function(t,e,n){t("loader").features.ins=!0},{}],4:[function(t,e,n){function r(){M++,N=y.hash,this[u]=g.now()}function o(){M--,y.hash!==N&&i(0,!0);var t=g.now();this[h]=~~this[h]+t-this[u],this[d]=t}function i(t,e){E.emit("newURL",[""+y,e])}function a(t,e){t.on(e,function(){this[e]=g.now()})}var s="-start",c="-end",f="-body",u="fn"+s,d="fn"+c,p="cb"+s,l="cb"+c,h="jsTime",m="fetch",v="addEventListener",w=window,y=w.location,g=t("loader");if(w[v]&&g.xhrWrappable){var b=t(10),x=t(11),E=t(8),O=t(6),P=t(13),R=t(7),T=t(14),L=t(9),j=t("ee"),S=j.get("tracer");t(15),g.features.spa=!0;var N,M=0;j.on(u,r),j.on(p,r),j.on(d,o),j.on(l,o),j.buffer([u,d,"xhr-done","xhr-resolved"]),O.buffer([u]),P.buffer(["setTimeout"+c,"clearTimeout"+s,u]),T.buffer([u,"new-xhr","send-xhr"+s]),R.buffer([m+s,m+"-done",m+f+s,m+f+c]),E.buffer(["newURL"]),b.buffer([u]),x.buffer(["propagate",p,l,"executor-err","resolve"+s]),S.buffer([u,"no-"+u]),L.buffer(["new-jsonp","cb-start","jsonp-error","jsonp-end"]),a(T,"send-xhr"+s),a(j,"xhr-resolved"),a(j,"xhr-done"),a(R,m+s),a(R,m+"-done"),a(L,"new-jsonp"),a(L,"jsonp-end"),a(L,"cb-start"),E.on("pushState-end",i),E.on("replaceState-end",i),w[v]("hashchange",i,!0),w[v]("load",i,!0),w[v]("popstate",function(){i(0,M>1)},!0)}},{}],5:[function(t,e,n){function r(t){}if(window.performance&&window.performance.timing&&window.performance.getEntriesByType){var o=t("ee"),i=t("handle"),a=t(13),s=t(12),c="learResourceTimings",f="addEventListener",u="resourcetimingbufferfull",d="bstResource",p="resource",l="-start",h="-end",m="fn"+l,v="fn"+h,w="bstTimer",y="pushState",g=t("loader");g.features.stn=!0,t(8);var b=NREUM.o.EV;o.on(m,function(t,e){var n=t[0];n instanceof b&&(this.bstStart=g.now())}),o.on(v,function(t,e){var n=t[0];n instanceof b&&i("bst",[n,e,this.bstStart,g.now()])}),a.on(m,function(t,e,n){this.bstStart=g.now(),this.bstType=n}),a.on(v,function(t,e){i(w,[e,this.bstStart,g.now(),this.bstType])}),s.on(m,function(){this.bstStart=g.now()}),s.on(v,function(t,e){i(w,[e,this.bstStart,g.now(),"requestAnimationFrame"])}),o.on(y+l,function(t){this.time=g.now(),this.startPath=location.pathname+location.hash}),o.on(y+h,function(t){i("bstHist",[location.pathname+location.hash,this.startPath,this.time])}),f in window.performance&&(window.performance["c"+c]?window.performance[f](u,function(t){i(d,[window.performance.getEntriesByType(p)]),window.performance["c"+c]()},!1):window.performance[f]("webkit"+u,function(t){i(d,[window.performance.getEntriesByType(p)]),window.performance["webkitC"+c]()},!1)),document[f]("scroll",r,{passive:!0}),document[f]("keypress",r,!1),document[f]("click",r,!1)}},{}],6:[function(t,e,n){function r(t){for(var e=t;e&&!e.hasOwnProperty(u);)e=Object.getPrototypeOf(e);e&&o(e)}function o(t){s.inPlace(t,[u,d],"-",i)}function i(t,e){return t[1]}var a=t("ee").get("events"),s=t(24)(a,!0),c=t("gos"),f=XMLHttpRequest,u="addEventListener",d="removeEventListener";e.exports=a,"getPrototypeOf"in Object?(r(document),r(window),r(f.prototype)):f.prototype.hasOwnProperty(u)&&(o(window),o(f.prototype)),a.on(u+"-start",function(t,e){var n=t[1],r=c(n,"nr@wrapped",function(){function t(){if("function"==typeof n.handleEvent)return n.handleEvent.apply(n,arguments)}var e={object:t,"function":n}[typeof n];return e?s(e,"fn-",null,e.name||"anonymous"):n});this.wrapped=t[1]=r}),a.on(d+"-start",function(t){t[1]=this.wrapped||t[1]})},{}],7:[function(t,e,n){function r(t,e,n){var r=t[e];"function"==typeof r&&(t[e]=function(){var t=r.apply(this,arguments);return o.emit(n+"start",arguments,t),t.then(function(e){return o.emit(n+"end",[null,e],t),e},function(e){throw o.emit(n+"end",[e],t),e})})}var o=t("ee").get("fetch"),i=t(21);e.exports=o;var a=window,s="fetch-",c=s+"body-",f=["arrayBuffer","blob","json","text","formData"],u=a.Request,d=a.Response,p=a.fetch,l="prototype";u&&d&&p&&(i(f,function(t,e){r(u[l],e,c),r(d[l],e,c)}),r(a,"fetch",s),o.on(s+"end",function(t,e){var n=this;if(e){var r=e.headers.get("content-length");null!==r&&(n.rxSize=r),o.emit(s+"done",[null,e],n)}else o.emit(s+"done",[t],n)}))},{}],8:[function(t,e,n){var r=t("ee").get("history"),o=t(24)(r);e.exports=r,o.inPlace(window.history,["pushState","replaceState"],"-")},{}],9:[function(t,e,n){function r(t){function e(){c.emit("jsonp-end",[],p),t.removeEventListener("load",e,!1),t.removeEventListener("error",n,!1)}function n(){c.emit("jsonp-error",[],p),c.emit("jsonp-end",[],p),t.removeEventListener("load",e,!1),t.removeEventListener("error",n,!1)}var r=t&&"string"==typeof t.nodeName&&"script"===t.nodeName.toLowerCase();if(r){var o="function"==typeof t.addEventListener;if(o){var a=i(t.src);if(a){var u=s(a),d="function"==typeof u.parent[u.key];if(d){var p={};f.inPlace(u.parent,[u.key],"cb-",p),t.addEventListener("load",e,!1),t.addEventListener("error",n,!1),c.emit("new-jsonp",[t.src],p)}}}}}function o(){return"addEventListener"in window}function i(t){var e=t.match(u);return e?e[1]:null}function a(t,e){var n=t.match(p),r=n[1],o=n[3];return o?a(o,e[r]):e[r]}function s(t){var e=t.match(d);return e&&e.length>=3?{key:e[2],parent:a(e[1],window)}:{key:t,parent:window}}var c=t("ee").get("jsonp"),f=t(24)(c);if(e.exports=c,o()){var u=/[?&](?:callback|cb)=([^&#]+)/,d=/(.*)\.([^.]+)/,p=/^(\w+)(\.|$)(.*)$/,l=["appendChild","insertBefore","replaceChild"];f.inPlace(HTMLElement.prototype,l,"dom-"),f.inPlace(HTMLHeadElement.prototype,l,"dom-"),f.inPlace(HTMLBodyElement.prototype,l,"dom-"),c.on("dom-start",function(t){r(t[0])})}},{}],10:[function(t,e,n){var r=t("ee").get("mutation"),o=t(24)(r),i=NREUM.o.MO;e.exports=r,i&&(window.MutationObserver=function(t){return this instanceof i?new i(o(t,"fn-")):i.apply(this,arguments)},MutationObserver.prototype=i.prototype)},{}],11:[function(t,e,n){function r(t){var e=a.context(),n=s(t,"executor-",e),r=new f(n);return a.context(r).getCtx=function(){return e},a.emit("new-promise",[r,e],e),r}function o(t,e){return e}var i=t(24),a=t("ee").get("promise"),s=i(a),c=t(21),f=NREUM.o.PR;e.exports=a,f&&(window.Promise=r,["all","race"].forEach(function(t){var e=f[t];f[t]=function(n){function r(t){return function(){a.emit("propagate",[null,!o],i),o=o||!t}}var o=!1;c(n,function(e,n){Promise.resolve(n).then(r("all"===t),r(!1))});var i=e.apply(f,arguments),s=f.resolve(i);return s}}),["resolve","reject"].forEach(function(t){var e=f[t];f[t]=function(t){var n=e.apply(f,arguments);return t!==n&&a.emit("propagate",[t,!0],n),n}}),f.prototype["catch"]=function(t){return this.then(null,t)},f.prototype=Object.create(f.prototype,{constructor:{value:r}}),c(Object.getOwnPropertyNames(f),function(t,e){try{r[e]=f[e]}catch(n){}}),a.on("executor-start",function(t){t[0]=s(t[0],"resolve-",this),t[1]=s(t[1],"resolve-",this)}),a.on("executor-err",function(t,e,n){t[1](n)}),s.inPlace(f.prototype,["then"],"then-",o),a.on("then-start",function(t,e){this.promise=e,t[0]=s(t[0],"cb-",this),t[1]=s(t[1],"cb-",this)}),a.on("then-end",function(t,e,n){this.nextPromise=n;var r=this.promise;a.emit("propagate",[r,!0],n)}),a.on("cb-end",function(t,e,n){a.emit("propagate",[n,!0],this.nextPromise)}),a.on("propagate",function(t,e,n){this.getCtx&&!e||(this.getCtx=function(){if(t instanceof Promise)var e=a.context(t);return e&&e.getCtx?e.getCtx():this})}),r.toString=function(){return""+f})},{}],12:[function(t,e,n){var r=t("ee").get("raf"),o=t(24)(r),i="equestAnimationFrame";e.exports=r,o.inPlace(window,["r"+i,"mozR"+i,"webkitR"+i,"msR"+i],"raf-"),r.on("raf-start",function(t){t[0]=o(t[0],"fn-")})},{}],13:[function(t,e,n){function r(t,e,n){t[0]=a(t[0],"fn-",null,n)}function o(t,e,n){this.method=n,this.timerDuration=isNaN(t[1])?0:+t[1],t[0]=a(t[0],"fn-",this,n)}var i=t("ee").get("timer"),a=t(24)(i),s="setTimeout",c="setInterval",f="clearTimeout",u="-start",d="-";e.exports=i,a.inPlace(window,[s,"setImmediate"],s+d),a.inPlace(window,[c],c+d),a.inPlace(window,[f,"clearImmediate"],f+d),i.on(c+u,r),i.on(s+u,o)},{}],14:[function(t,e,n){function r(t,e){d.inPlace(e,["onreadystatechange"],"fn-",s)}function o(){var t=this,e=u.context(t);t.readyState>3&&!e.resolved&&(e.resolved=!0,u.emit("xhr-resolved",[],t)),d.inPlace(t,y,"fn-",s)}function i(t){g.push(t),h&&(x?x.then(a):v?v(a):(E=-E,O.data=E))}function a(){for(var t=0;t<g.length;t++)r([],g[t]);g.length&&(g=[])}function s(t,e){return e}function c(t,e){for(var n in t)e[n]=t[n];return e}t(6);var f=t("ee"),u=f.get("xhr"),d=t(24)(u),p=NREUM.o,l=p.XHR,h=p.MO,m=p.PR,v=p.SI,w="readystatechange",y=["onload","onerror","onabort","onloadstart","onloadend","onprogress","ontimeout"],g=[];e.exports=u;var b=window.XMLHttpRequest=function(t){var e=new l(t);try{u.emit("new-xhr",[e],e),e.addEventListener(w,o,!1)}catch(n){try{u.emit("internal-error",[n])}catch(r){}}return e};if(c(l,b),b.prototype=l.prototype,d.inPlace(b.prototype,["open","send"],"-xhr-",s),u.on("send-xhr-start",function(t,e){r(t,e),i(e)}),u.on("open-xhr-start",r),h){var x=m&&m.resolve();if(!v&&!m){var E=1,O=document.createTextNode(E);new h(a).observe(O,{characterData:!0})}}else f.on("fn-end",function(t){t[0]&&t[0].type===w||a()})},{}],15:[function(t,e,n){function r(t){var e=this.params,n=this.metrics;if(!this.ended){this.ended=!0;for(var r=0;r<d;r++)t.removeEventListener(u[r],this.listener,!1);if(!e.aborted){if(n.duration=a.now()-this.startTime,4===t.readyState){e.status=t.status;var i=o(t,this.lastSize);if(i&&(n.rxSize=i),this.sameOrigin){var c=t.getResponseHeader("X-NewRelic-App-Data");c&&(e.cat=c.split(", ").pop())}}else e.status=0;n.cbTime=this.cbTime,f.emit("xhr-done",[t],t),s("xhr",[e,n,this.startTime])}}}function o(t,e){var n=t.responseType;if("json"===n&&null!==e)return e;var r="arraybuffer"===n||"blob"===n||"json"===n?t.response:t.responseText;return h(r)}function i(t,e){var n=c(e),r=t.params;r.host=n.hostname+":"+n.port,r.pathname=n.pathname,t.sameOrigin=n.sameOrigin}var a=t("loader");if(a.xhrWrappable){var s=t("handle"),c=t(16),f=t("ee"),u=["load","error","abort","timeout"],d=u.length,p=t("id"),l=t(19),h=t(18),m=window.XMLHttpRequest;a.features.xhr=!0,t(14),f.on("new-xhr",function(t){var e=this;e.totalCbs=0,e.called=0,e.cbTime=0,e.end=r,e.ended=!1,e.xhrGuids={},e.lastSize=null,l&&(l>34||l<10)||window.opera||t.addEventListener("progress",function(t){e.lastSize=t.loaded},!1)}),f.on("open-xhr-start",function(t){this.params={method:t[0]},i(this,t[1]),this.metrics={}}),f.on("open-xhr-end",function(t,e){"loader_config"in NREUM&&"xpid"in NREUM.loader_config&&this.sameOrigin&&e.setRequestHeader("X-NewRelic-ID",NREUM.loader_config.xpid)}),f.on("send-xhr-start",function(t,e){var n=this.metrics,r=t[0],o=this;if(n&&r){var i=h(r);i&&(n.txSize=i)}this.startTime=a.now(),this.listener=function(t){try{"abort"===t.type&&(o.params.aborted=!0),("load"!==t.type||o.called===o.totalCbs&&(o.onloadCalled||"function"!=typeof e.onload))&&o.end(e)}catch(n){try{f.emit("internal-error",[n])}catch(r){}}};for(var s=0;s<d;s++)e.addEventListener(u[s],this.listener,!1)}),f.on("xhr-cb-time",function(t,e,n){this.cbTime+=t,e?this.onloadCalled=!0:this.called+=1,this.called!==this.totalCbs||!this.onloadCalled&&"function"==typeof n.onload||this.end(n)}),f.on("xhr-load-added",function(t,e){var n=""+p(t)+!!e;this.xhrGuids&&!this.xhrGuids[n]&&(this.xhrGuids[n]=!0,this.totalCbs+=1)}),f.on("xhr-load-removed",function(t,e){var n=""+p(t)+!!e;this.xhrGuids&&this.xhrGuids[n]&&(delete this.xhrGuids[n],this.totalCbs-=1)}),f.on("addEventListener-end",function(t,e){e instanceof m&&"load"===t[0]&&f.emit("xhr-load-added",[t[1],t[2]],e)}),f.on("removeEventListener-end",function(t,e){e instanceof m&&"load"===t[0]&&f.emit("xhr-load-removed",[t[1],t[2]],e)}),f.on("fn-start",function(t,e,n){e instanceof m&&("onload"===n&&(this.onload=!0),("load"===(t[0]&&t[0].type)||this.onload)&&(this.xhrCbStart=a.now()))}),f.on("fn-end",function(t,e){this.xhrCbStart&&f.emit("xhr-cb-time",[a.now()-this.xhrCbStart,this.onload,e],e)})}},{}],16:[function(t,e,n){e.exports=function(t){var e=document.createElement("a"),n=window.location,r={};e.href=t,r.port=e.port;var o=e.href.split("://");!r.port&&o[1]&&(r.port=o[1].split("../index.html")[0].split("@").pop().split(":")[1]),r.port&&"0"!==r.port||(r.port="https"===o[0]?"443":"80"),r.hostname=e.hostname||n.hostname,r.pathname=e.pathname,r.protocol=o[0],"/"!==r.pathname.charAt(0)&&(r.pathname="/"+r.pathname);var i=!e.protocol||":"===e.protocol||e.protocol===n.protocol,a=e.hostname===document.domain&&e.port===n.port;return r.sameOrigin=i&&(!e.hostname||a),r}},{}],17:[function(t,e,n){function r(){}function o(t,e,n){return function(){return i(t,[f.now()].concat(s(arguments)),e?null:this,n),e?void 0:this}}var i=t("handle"),a=t(21),s=t(22),c=t("ee").get("tracer"),f=t("loader"),u=NREUM;"undefined"==typeof window.newrelic&&(newrelic=u);var d=["setPageViewName","setCustomAttribute","setErrorHandler","finished","addToTrace","inlineHit","addRelease"],p="api-",l=p+"ixn-";a(d,function(t,e){u[e]=o(p+e,!0,"api")}),u.addPageAction=o(p+"addPageAction",!0),u.setCurrentRouteName=o(p+"routeName",!0),e.exports=newrelic,u.interaction=function(){return(new r).get()};var h=r.prototype={createTracer:function(t,e){var n={},r=this,o="function"==typeof e;return i(l+"tracer",[f.now(),t,n],r),function(){if(c.emit((o?"":"no-")+"fn-start",[f.now(),r,o],n),o)try{return e.apply(this,arguments)}catch(t){throw c.emit("fn-err",[arguments,this,t],n),t}finally{c.emit("fn-end",[f.now()],n)}}}};a("actionText,setName,setAttribute,save,ignore,onEnd,getContext,end,get".split(","),function(t,e){h[e]=o(l+e)}),newrelic.noticeError=function(t){"string"==typeof t&&(t=new Error(t)),i("err",[t,f.now()])}},{}],18:[function(t,e,n){e.exports=function(t){if("string"==typeof t&&t.length)return t.length;if("object"==typeof t){if("undefined"!=typeof ArrayBuffer&&t instanceof ArrayBuffer&&t.byteLength)return t.byteLength;if("undefined"!=typeof Blob&&t instanceof Blob&&t.size)return t.size;if(!("undefined"!=typeof FormData&&t instanceof FormData))try{return JSON.stringify(t).length}catch(e){return}}}},{}],19:[function(t,e,n){var r=0,o=navigator.userAgent.match(/Firefox[\/\s](\d+\.\d+)/);o&&(r=+o[1]),e.exports=r},{}],20:[function(t,e,n){function r(t,e){if(!o)return!1;if(t!==o)return!1;if(!e)return!0;if(!i)return!1;for(var n=i.split("."),r=e.split("."),a=0;a<r.length;a++)if(r[a]!==n[a])return!1;return!0}var o=null,i=null,a=/Version\/(\S+)\s+Safari/;if(navigator.userAgent){var s=navigator.userAgent,c=s.match(a);c&&s.indexOf("Chrome")===-1&&s.indexOf("Chromium")===-1&&(o="Safari",i=c[1])}e.exports={agent:o,version:i,match:r}},{}],21:[function(t,e,n){function r(t,e){var n=[],r="",i=0;for(r in t)o.call(t,r)&&(n[i]=e(r,t[r]),i+=1);return n}var o=Object.prototype.hasOwnProperty;e.exports=r},{}],22:[function(t,e,n){function r(t,e,n){e||(e=0),"undefined"==typeof n&&(n=t?t.length:0);for(var r=-1,o=n-e||0,i=Array(o<0?0:o);++r<o;)i[r]=t[e+r];return i}e.exports=r},{}],23:[function(t,e,n){e.exports={exists:"undefined"!=typeof window.performance&&window.performance.timing&&"undefined"!=typeof window.performance.timing.navigationStart}},{}],24:[function(t,e,n){function r(t){return!(t&&t instanceof Function&&t.apply&&!t[a])}var o=t("ee"),i=t(22),a="nr@original",s=Object.prototype.hasOwnProperty,c=!1;e.exports=function(t,e){function n(t,e,n,o){function nrWrapper(){var r,a,s,c;try{a=this,r=i(arguments),s="function"==typeof n?n(r,a):n||{}}catch(f){p([f,"",[r,a,o],s])}u(e+"start",[r,a,o],s);try{return c=t.apply(a,r)}catch(d){throw u(e+"err",[r,a,d],s),d}finally{u(e+"end",[r,a,c],s)}}return r(t)?t:(e||(e=""),nrWrapper[a]=t,d(t,nrWrapper),nrWrapper)}function f(t,e,o,i){o||(o="");var a,s,c,f="-"===o.charAt(0);for(c=0;c<e.length;c++)s=e[c],a=t[s],r(a)||(t[s]=n(a,f?s+o:o,i,s))}function u(n,r,o){if(!c||e){var i=c;c=!0;try{t.emit(n,r,o,e)}catch(a){p([a,n,r,o])}c=i}}function d(t,e){if(Object.defineProperty&&Object.keys)try{var n=Object.keys(t);return n.forEach(function(n){Object.defineProperty(e,n,{get:function(){return t[n]},set:function(e){return t[n]=e,e}})}),e}catch(r){p([r])}for(var o in t)s.call(t,o)&&(e[o]=t[o]);return e}function p(e){try{t.emit("internal-error",e)}catch(n){}}return t||(t=o),n.inPlace=f,n.flag=a,n}},{}],ee:[function(t,e,n){function r(){}function o(t){function e(t){return t&&t instanceof r?t:t?c(t,s,i):i()}function n(n,r,o,i){if(!p.aborted||i){t&&t(n,r,o);for(var a=e(o),s=m(n),c=s.length,f=0;f<c;f++)s[f].apply(a,r);var d=u[g[n]];return d&&d.push([b,n,r,a]),a}}function l(t,e){y[t]=m(t).concat(e)}function h(t,e){var n=y[t];if(n)for(var r=0;r<n.length;r++)n[r]===e&&n.splice(r,1)}function m(t){return y[t]||[]}function v(t){return d[t]=d[t]||o(n)}function w(t,e){f(t,function(t,n){e=e||"feature",g[n]=e,e in u||(u[e]=[])})}var y={},g={},b={on:l,addEventListener:l,removeEventListener:h,emit:n,get:v,listeners:m,context:e,buffer:w,abort:a,aborted:!1};return b}function i(){return new r}function a(){(u.api||u.feature)&&(p.aborted=!0,u=p.backlog={})}var s="nr@context",c=t("gos"),f=t(21),u={},d={},p=e.exports=o();p.backlog=u},{}],gos:[function(t,e,n){function r(t,e,n){if(o.call(t,e))return t[e];var r=n();if(Object.defineProperty&&Object.keys)try{return Object.defineProperty(t,e,{value:r,writable:!0,enumerable:!1}),r}catch(i){}return t[e]=r,r}var o=Object.prototype.hasOwnProperty;e.exports=r},{}],handle:[function(t,e,n){function r(t,e,n,r){o.buffer([t],r),o.emit(t,e,n)}var o=t("ee").get("handle");e.exports=r,r.ee=o},{}],id:[function(t,e,n){function r(t){var e=typeof t;return!t||"object"!==e&&"function"!==e?-1:t===window?0:a(t,i,function(){return o++})}var o=1,i="nr@id",a=t("gos");e.exports=r},{}],loader:[function(t,e,n){function r(){if(!E++){var t=x.info=NREUM.info,e=l.getElementsByTagName("script")[0];if(setTimeout(u.abort,3e4),!(t&&t.licenseKey&&t.applicationID&&e))return u.abort();f(g,function(e,n){t[e]||(t[e]=n)}),c("mark",["onload",a()+x.offset],null,"api");var n=l.createElement("script");n.src="https://"+t.agent,e.parentNode.insertBefore(n,e)}}function o(){"complete"===l.readyState&&i()}function i(){c("mark",["domContent",a()+x.offset],null,"api")}function a(){return O.exists&&performance.now?Math.round(performance.now()):(s=Math.max((new Date).getTime(),s))-x.offset}var s=(new Date).getTime(),c=t("handle"),f=t(21),u=t("ee"),d=t(20),p=window,l=p.document,h="addEventListener",m="attachEvent",v=p.XMLHttpRequest,w=v&&v.prototype;NREUM.o={ST:setTimeout,SI:p.setImmediate,CT:clearTimeout,XHR:v,REQ:p.Request,EV:p.Event,PR:p.Promise,MO:p.MutationObserver};var y=""+location,g={beacon:"bam.nr-data.net",errorBeacon:"bam.nr-data.net",agent:"js-agent.newrelic.com/nr-spa-1099.min.js"},b=v&&w&&w[h]&&!/CriOS/.test(navigator.userAgent),x=e.exports={offset:s,now:a,origin:y,features:{},xhrWrappable:b,userAgent:d};t(17),l[h]?(l[h]("DOMContentLoaded",i,!1),p[h]("load",r,!1)):(l[m]("onreadystatechange",o),p[m]("onload",r)),c("mark",["firstbyte",s],null,"api");var E=0,O=t(23)},{}]},{},["loader",2,15,5,3,4]);</script>
  <script>
//<![CDATA[
window.TT = 'eyJ1cmwiOiJodHRwczovL3R0LmJldHRlcm1lbnQuY29tIiwiY29va2llRG9tYWluIjoiLmJldHRlcm1lbnQuY29tIiwiY29va2llTmFtZSI6InR0X3Zpc2l0b3JfaWQiLCJyZWdpc3RyeSI6eyJtb2JpbGVfZ29hbF9wcm9qZWN0aW9uc19xMl8yMDE4X3NhZmVfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX2FnZ3JlZ2F0aW9uX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiZ29hbHNfcGhhc2Vfb25lXzIwMTYiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImV4dGVybmFsX2FjY291bnRfdHJhbnNmZXJfcHJldmlld19xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9mb3JjZWRfd2Fsa3Rocm91Z2hfcTJfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJhbGxvY2F0aW9uX3Jldmlld19yZWZhY3Rvcl9nb2FsX2NyZWF0aW9uX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiY29tcG9uZW50X3JldmVyc2Fsc19lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJwb3J0Zm9saW9fdXBncmFkZV9tZXNzYWdpbmdfcTJfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfY3ByX3plbmRlc2tfd2ViX3dpZGdldF9xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImV4dGVybmFsX2FjY291bnRfdHJhbnNmZXJfcHJldmlld19xMl8yMDE4X2V4cGVyaW1lbnQiOnsidHJlYXRtZW50Ijo1MCwiY29udHJvbCI6NTB9LCJiNGFfcmFpbHNfc2lnbnVwX2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF9jaGFybGllX21lZGlhX2Rlc3RpbmF0aW9uX3Rlc3RfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYjRhX3N1Yl9hY2NvdW50X2RhdGEiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImI0YV9wb3J0Zm9saW9fc3RyYXRlZ2llcyI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwic3ViX2FjY291bnRfcG93ZXJlZF9hZHZpc29yX2Rhc2hib2FyZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibm92ZW1iZXJfMjAxNl9wcm9tb19leHBlcmltZW50Ijp7ImNvbnRyb2wiOjM0LCJoaWdoIjozMywibG93IjozM30sIm1vYmlsZV9mb3JjZWRfd2Fsa3Rocm91Z2hfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50IjowfSwicm9sbG92ZXJfcmVkZXNpZ25lZF90cmFuc2Zlcl9wcmV2aWV3X3EyXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMDAsInRyZWF0bWVudCI6MH0sImFsbG9jYXRpb25fcmV2aWV3X3JlZmFjdG9yX2dvYWxfY3JlYXRpb25fcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsImV4cGVyaW1lbnQiOjEwMH0sInJldGFpbF9jcHJfemVuZGVza193ZWJfd2lkZ2V0X3EyXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sImZvdXJfb2hfb25lX2tfcm9sbG92ZXJfaW5zdHJ1Y3Rpb25zX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX2lvc19maXhfcXVvdm9fY29ubmVjdGlvbnNfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJtb2JpbGVfcmV3YXJkc19jZW50ZXJfcTFfMjAxOV9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwidGF4X3llYXJfbWF4X291dF9xMV8yMDE5X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImJhc2ljX3NpZ251cF9mbG93X2NvbnRpbnVlX3NwaW5uZXJfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwibW9iaWxlX2dvYWxfcHJvamVjdGlvbnNfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX3dlYl9wYWxzX2Rlc3RpbmF0aW9uX3Rlc3RfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYWxsb2NhdGlvbl9yZXZpZXdfcmVmYWN0b3JfZXhpc3RpbmdfZ29hbF9xMl8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF90b19iNGFfZXZlbnRzX2Rpc2FibGVkIjp7ImZhbHNlIjoxMDAsInRydWUiOjB9LCJwZXJmb3JtYW5jZV9wYWdlX2phdmFzY3JpcHRfcmVmYWN0b3JfcTJfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJnb2FsX3JlY29tbWVuZGF0aW9uX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiYWR2aXNvcl9qb2ludF9hY2NvdW50X2dvYWxfY3JlYXRpb25fcTJfMjAxOF9lbmFibGVkIjp7ImZhbHNlIjowLCJ0cnVlIjoxMDB9LCJyZXRhaWxfaXJhX3JvbGxvdmVyX3BpenphX3RyYWNrZXJfcTJfMjAxOF9lbmFibGVkIjp7ImZhbHNlIjoxMDAsInRydWUiOjB9LCJ0ZW51cmVkX2F1dG9tYXRpY19kZXBvc2l0X3EzXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sInJldGFpbF9lbXBvd2VyaW5nX21lZGlhX2Rlc3RpbmF0aW9uX3Rlc3RfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwibW9iaWxlX2F1dG9fd2Fsa3Rocm91Z2hfcTJfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfYXV0b21hdGljX3JvbGxvdmVyX2NoZWNrX2RlcG9zaXRfcTNfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyb2xsb3Zlcl9jb21wbGV0ZV90Y3BfYWR2aWNlX3ExXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sIm1vYmlsZV9hZ2dyZWdhdGlvbl9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRhaWxfbmVyZF93YWxsZXRfZGVzdGluYXRpb25fdGVzdF9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJhbGxvY2F0aW9uX3Jldmlld19yZWZhY3Rvcl9leGlzdGluZ19nb2FsX3EyXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJleHBlcmltZW50IjoxMDB9LCJwb3N0X3NpZ251cF9mcmVlX2NhbGxfcTFfMjAxNyI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sIm1vYmlsZV9ldmVyeWRheV9zaWdudXBfcTNfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwibW9iaWxlX2F1dG9fd2Fsa3Rocm91Z2hfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50IjowfSwibW9iaWxlX2FuZHJvaWRfZml4X3F1b3ZvX2Nvbm5lY3Rpb25zX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwidGVudXJlZF9hdXRvbWF0aWNfZGVwb3NpdF9xM18yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF9zbWFydF9zYXZlcl9pbl9nb2FsX3NlbGVjdGlvbl9xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJiNGJfY29udHJpYnV0aW9uX3NvdXJjZV9icmVha2Rvd25fZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiYjRiX29uYm9hcmRpbmdfZmxvd19vdXRzaWRlX3NwYSI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiZGVjb252ZXJzaW9uX3JlcG9ydHNfZ2VuZXJhYmxlIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJicm9jaHVyZV96ZW5kZXNrX3RhbGtfcTFfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50IjowfSwicmV0YWlsX2xpc3Rlbl9tb25leV9tYXR0ZXJzX2Rlc3RpbmF0aW9uX3Rlc3RfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiaW5jbHVkZV9hZHZpY2VfaW5fcXVhcnRlcmx5X3N0YXRlbWVudF9xMV8yMDE3Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYjRhX2dvYWxfc3RhdHVzX2Rpc2FibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJmb3JtX3JlZGVzaWduX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sIm1vYmlsZV9ldmVyeWRheV9zaWdudXBfcTNfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJwZXJmb3JtYW5jZV9wYWdlX2ltcHJvdmVtZW50c19xM18yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9ncmFwaGluZ19xNF8yMDE3X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJtb2JpbGVfZ3JhcGhpbmdfdjJfcTRfMjAxN19leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX2ludmVzdG9wZWRpYV9kZXN0aW5hdGlvbl90ZXN0X3EyXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImI0Yl9yZWFjdF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJtb2JpbGVfb3V0c21hcnRfYXZlcmFnZV9ob21lX3NjcmVlbl9xM18yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9vdXRzbWFydF9hdmVyYWdlX2hvbWVfc2NyZWVuX3EzXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sInJldGFpbF91bmZ1bmRlZF9zaW5nbGVfZGVwb3NpdF9xNF8yMDE4X29mZmVyX2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRhaWxfc21hcnRfc2F2ZXJfaW5fZ29hbF9zZWxlY3Rpb25fcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfNDAxa193aGl0ZV9nbG92ZV9yb2xsb3Zlcl9xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJtb2JpbGVfYW5kcm9pZF9yZXdhcmRzX2NlbnRlcl9xMV8yMDE5X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImdhaW5fbG9zc19yZXBvcnRzX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX2ludGVyaW1fc3RhdGVtZW50X2dlbmVyYXRpb25fcTFfMjAxOV9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfZ2VuZXJhbF9hZmZpbGlhdGVfZGVzdGluYXRpb25fdGVzdF9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJ1bmZ1bmRlZF93ZWxjb21lX3Nlcmllc19maXJzdF93ZWVrX3EzXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImZ1bmRlZF93ZWxjb21lX3Nlcmllc19jYW1wYWlnbl9xM18yMDE3X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAsInRyZWF0bWVudCI6OTB9LCJtb2JpbGVfaW5pdGlhbF9vbmVfdGltZV9kZXBvc2l0X3EyXzIwMTdfZW5hYmxlZCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sImludGVncmF0aW9uX2Vycm9yX2Rpc3BsYXlfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwicmV0YWlsX3R3b193YXlfc3dlZXBfcTNfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJtaW50X3RyYW5zYWN0aW9uc19xM18yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9nb2FsX2ZhYl9xMV8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MCwidHJlYXRtZW50IjoxMDB9LCJyZXRhaWxfdGVudXJlZF9zbWFydF9zYXZlcl9wcm9tb19zaXhfbW9udGhzX3EzXzIwMThfZW5yb2xsbWVudF9jcmVhdGlvbl9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfdGVudXJlZF9zbWFydF9zYXZlcl9wcm9tb190aHJlZV9tb250aHNfcTNfMjAxOF9lbnJvbGxtZW50X2NyZWF0aW9uX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF9maXJzdF9yZWZlcnJhbF9lbWFpbF9xM18yMDE4X3YyX2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJkaXJlY3RfbWFpbF9mdW5kaW5nX3JlbWluZGVyX3EyXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sInJldGFpbF93aGl0ZV9nbG92ZV9pcmFfcm9sbG92ZXJzX3EzXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiYjRhX2Fkdmlzb3JfdHJ1c3RfY3JlYXRpb25fcTNfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJleHRlcm5hbF9hY2NvdW50X292ZXJyaWRlbl95aWVsZF9xM18yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF9zbWFydF9zYXZlcl9pbl9ndWlkZWRfc2lnbnVwX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImRyX3BlcnNvbmFsX3JlZmVycmFsX2NyZWF0aW9uX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInVuZnVuZGVkX3dlbGNvbWVfc2VyaWVzX2NhbXBhaWduX3EzXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMCwidHJlYXRtZW50Ijo5MH0sIm1vYmlsZV9zdW1tYXJ5X2RlcG9zaXRfYnV0dG9uX3EzXzIwMTdfZXhwZXJpbWVudCI6eyJjb250cm9sIjowLCJ0cmVhdG1lbnQiOjEwMH0sInJldGFpbF93ZWxjb21lX3NjcmVlbl9zbWFydF9zYXZlcl9xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRhaWxfYXBwX2RheV83X3VuZnVuZGVkX3NpbmdsZV9kZXBvc2l0X29mZmVyX2Vucm9sbG1lbnRfam9iX2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF9pbl9hcHBfZ3VpZGVfZXh0cmFfdGFza3NfcTRfMjAxOF92Ml9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50IjowfSwidHdvX3dheV9zd2VlcF9ib3VuZF9hZGp1c3RtZW50X3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX3Nob3dfYWNhdF9jdGFfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfZ2V0X3N0YXJ0ZWRfZmluYW5jaWFsX3BsYW5fcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50X2d1aWRlZF9zaWdudXBfb25seSI6MCwidHJlYXRtZW50X2ZpbmFuY2lhbF9wbGFuX29ubHkiOjAsInRyZWF0bWVudF9maW5hbmNpYWxfcGxhbl9hbHQiOjB9LCJ0ZW51cmVkX3RheF95ZWFyX21heF9vdXRfcTFfMjAxOV9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX2xlZ2FsX2FjY291bnRfaW5fYmFzaWNfc2lnbnVwX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sInJldGFpbF90d29fdGFza3NfaW5fYXBwX2d1aWRlX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX2RlbW9fbW9kZV9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJtb2JpbGVfbm90aGluZ19xMV8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJtb2JpbGVfb3V0c21hcnRfYXZlcmFnZV9ob21lX3NjcmVlbl9xM18yMDE4X3YyX2VuYWJsZWQiOnsiZmFsc2UiOjEwMCwidHJ1ZSI6MH0sImJyb2NodXJlX3JlYWN0X3N3aXRjaGluZ19jb3N0X2NhbGN1bGF0b3JfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfd2hpdGVfZ2xvdmVfaXJhX3JvbGxvdmVyc19xM18yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZWZlcl9hX2ZyaWVuZF92Ml9lbmFibGVkIjp7ImZhbHNlIjoxMDAsInRydWUiOjB9LCJiNGFfaGlnaF9wcmlvcml0eV9ub3RpZmljYXRpb25fZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMDAsImFkZF9nb2FsIjowLCJ0YXhhYmxlX2FjYXRzIjowLCJkaWdpdGFsX3JvbGxvdmVyX3VwZGF0ZSI6MCwidGF4X3dpdGhob2xkaW5nIjowLCJqb2ludF9hY2NvdW50IjowLCJyb2xsb3ZlciI6MH0sInJldGFpbF90ZW51cmVkX3NtYXJ0X3NhdmVyX3Byb21vX3YyX3EzXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMDAsInRyZWF0bWVudF90aHJlZV9tb250aHMiOjAsInRyZWF0bWVudF9zaXhfbW9udGhzIjowfSwibW9iaWxlX2RlbW9fbW9kZV9xMV8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJtb2JpbGVfaW52ZXN0ZWRfZ3JhcGhfcTFfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwibmF2aWdhdGlvbl9zaWRlYmFyX3VwZGF0ZXNfcTNfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwibW9iaWxlX3F1b3ZvX2JhbmtfbGlua2luZ19xM18yMDE4X2VuYWJsZWQiOnsiZmFsc2UiOjAsInRydWUiOjEwMH0sIm5hdmlnYXRpb25fc2lkZWJhcl91cGRhdGVzX3EzXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX2FwcF9uYXZfZWFybl9yZXdhcmRzX3EzXzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjoxMDAsInRyZWF0bWVudCI6MH0sImI0YV9uYXZpZ2F0aW9uX3JlYXJjaGl0ZWN0dXJlX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX291dHNtYXJ0X2F2ZXJhZ2VfaG9tZV9zY3JlZW5fcTNfMjAxOF92Ml9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjEwMCwidHJlYXRtZW50IjowfSwibW9iaWxlX2lvc190d29fd2F5X3N3ZWVwX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX3RlbnVyZWRfc21hcnRfc2F2ZXJfcHJvbW9fdjJfcTNfMjAxOF9nYXRlX2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MTAwLCJ0cmVhdG1lbnQiOjB9LCJtb2JpbGVfc2lnbnVwX2NvcHlfcTJfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwibW9iaWxlX3F1b3ZvX2JhbmtfbGlua2luZ19xM18yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MCwidHJlYXRtZW50IjoxMDB9LCJicm9jaHVyZV9ob21lcGFnZV9kZXNrdG9wX21hZ2dpZV9oZXJvX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sInJldGFpbF90d29fdGFza3NfaW5fYXBwX2d1aWRlX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImRlZmF1bHRfZ29hbHNfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX3Nob3dfYWNhdF9jdGFfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiYnJvY2h1cmVfbW9iaWxlX21hZ2dpZV9oZXJvX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImJyb2NodXJlX21vYmlsZV9uYXZfYjJiX2xpbmtzX3E0XzIwMThfZXhwZXJpbWVudCI6eyJjb250cm9sIjo1MCwidHJlYXRtZW50Ijo1MH0sImI0YV9iNGJfZGVmYXVsdF9nb2Fsc19xNF8yMDE4X2VuYWJsZWQiOnsiZmFsc2UiOjEwMCwidHJ1ZSI6MH0sIm1vYmlsZV9pb3NfcmV3YXJkc19jZW50ZXJfcTFfMjAxOV9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJtb2JpbGVfYW5kcm9pZF90d29fd2F5X3N3ZWVwX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX3R3b193YXlfc3dlZXBfY2FuY2VsYWJsZV90cmFuc2FjdGlvbnNfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJicm9jaHVyZV9iMmJfbGlua3NfaW5faG9tZXBhZ2VfaGVyb19xNF8yMDE4Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwibW9iaWxlX2FuZHJvaWRfd2l0aGRyYXdhbF9hbHRlcm5hdGl2ZXNfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJicm9jaHVyZV9wcm9zcGVjdF9ob21lcGFnZV9tYWdnaWVfdmlkZW9fcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwiZGl2aWRlbmRfcmVwb3J0c19xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF9hcHBfb2ZmZXJfZW5yb2xsbWVudF9qb2JzX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwibW9iaWxlX2lvc19zdW1tYXJ5X2ZhYl9xMl8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJtb2JpbGVfZ29hbF9ncmFwaF9xMV8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJwcm94eV90aWNrZXJzX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwicmV0YWlsX2luX2FwcF9ndWlkZV9leHRyYV90YXNrc19xNF8yMDE4X3YyX2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9nb2FsX3Byb2plY3Rpb25zX3EyXzIwMThfc2FmZV9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwiYjRhX3Nob3dfYmFsYW5jZXNfY2xpZW50X2luZGV4X3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicXVvdm9fcmVmcmVzaGluZ19yZWdhcmRsZXNzX29mX2Z1bmRpbmdfZW5hYmxlZCI6eyJ0cnVlIjo1MCwiZmFsc2UiOjUwfSwicm9sbG92ZXJfcHJvbW90aW9uXzIwMTZfcTJfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwiZG9jdW1lbnRfdmF1bHRfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwidGVudXJlZF9yb2xsb3Zlcl9wcm9tb19xMV8yMDE5X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJyZXRhaWxfbGVnYWxfYWNjb3VudF9pbl9iYXNpY19zaWdudXBfcTRfMjAxOF9lbmFibGVkIjp7ImZhbHNlIjowLCJ0cnVlIjoxMDB9LCJyZXRhaWxfY2FzaF9hbmFseXNpc193aXRob3V0X3NtYXJ0X3NhdmVyX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX3RyYW5zZmVyX2ltcHJvdmVtZW50X2FjYXRzX2Zsb3dfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJmbGV4aWJsZV9wb3J0Zm9saW9fY29tbW9kaXRpZXNfZW5hYmxlZF9xNF8yMDE4Ijp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJkaWdpdGFsX2R1cGxpY2F0ZV9zdGF0ZW1lbnRzX2Zvcl9rcG1nX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImRpZ2l0YWxfZHVwbGljYXRlX3N0YXRlbWVudHNfZm9yX3NwX2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImRpZ2l0YWxfZHVwbGljYXRlX3N0YXRlbWVudHNfZm9yX3B3Y19lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJkaWdpdGFsX2R1cGxpY2F0ZV9zdGF0ZW1lbnRzX2Zvcl9kZWxvaXR0ZV9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJkaWdpdGFsX2R1cGxpY2F0ZV9zdGF0ZW1lbnRzX2Zvcl9leV9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJkcl9wb3J0Zm9saW9fbWFuYWdlbWVudF9hcGlfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJhbGxvY2F0aW9uX3NlbGVjdGlvbl9yZWZhY3Rvcl9xMV8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInB1c2hfbm90aWZpY2F0aW9uc19xMV8yMDE3X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInBvcnRmb2xpb19tYW5hZ2VtZW50X2FwaV8yMDE3X3E0X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sImI0YV9jb21wbGlhbmNlX2ZlZXNfMjAxN19lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfemVuZGVza19sdHZfcXVldWVfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX3RyYW5zZmVyX2ltcHJvdmVtZW50X2FjYXRzX2Zsb3dfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwibW9iaWxlX2dyYXBoaW5nX3E0XzIwMTdfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX2ludmVzdGluZ19hc3Nlc3NtZW50X2NvbnN1bHRhdGlvbl9lbmFibGVkIjp7ImZhbHNlIjoxMDAsInRydWUiOjB9LCJtb2JpbGVfZ29hbF9mYWJfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJiNGFfYWRkX2dvYWxfbm90aWZpY2F0aW9uX3E0XzIwMTdfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwibW9iaWxlX21lc3NhZ2luZ19xM18yMDE3X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sImRpcmVjdF9tYWlsX2Z1bmRpbmdfcmVtaW5kZXJfcTJfMjAxN19lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJtb2JpbGVfbmF0aXZlX3NpZ251cF9xMl8yMDE3X2VuYWJsZWQiOnsiZmFsc2UiOjAsInRydWUiOjEwMH0sIm1vYmlsZV9zdW1tYXJ5X2RlcG9zaXRfYnV0dG9uX3EzXzIwMTdfZW5hYmxlZCI6eyJmYWxzZSI6MCwidHJ1ZSI6MTAwfSwicGVyZm9ybWFuY2VfcGFnZV9pbXByb3ZlbWVudHNfcTNfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjAsInRyZWF0bWVudCI6MTAwfSwibW9iaWxlX2ZyZWVfdGltZV9wcm9tb19xM18yMDE3X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9nb2FsX3Byb2plY3Rpb25zX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwic2RhXzEwMGtfZ2F0ZV8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInJldGFpbF90ZW51cmVkX3JvbGxvdmVyX2RvbGxhcnNfbWFuYWdlZF9mcmVlX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwibW9iaWxlX3NpZ251cF9jb3B5X3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiYjRhX2Fkdmlzb3JfaW1wZXJzb25hdGlvbl9tb2RhbF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJtb2JpbGVfZ3JhcGhpbmdfdjJfcTRfMjAxN19lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJtb2JpbGVfaW52ZXN0ZWRfZ3JhcGhfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJhZGRfcHJlZmVycmVkX211bmlfYm9uZF9sb2NhbGVfc2VsZWN0aW9uX3RvX2RyX2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF9kb2N0b3JfcmVicmFuZF9xMV8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF9hbWVyaWNhbl9haXJsaW5lc19vZmZlcl9xMV8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9pb3Nfd2l0aGRyYXdhbF9hbHRlcm5hdGl2ZXNfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJtb2JpbGVfaW9zX3N1bW1hcnlfZmFiX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwiZHJfcGFwZXJsZXNzX2Rpc3RyaWJ1dGlvbl9lbGlnaWJpbGl0eV9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJiNGFfc2RhX3BvcnRmb2xpb3NfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJwb3J0Zm9saW9fbWFuYWdlbWVudF9nb2FsX3BvcnRmb2xpb18yMDE3X3E0X2VuYWJsZWQiOnsidHJ1ZSI6MCwiZmFsc2UiOjEwMH0sInJldGFpbF90cnVzdGVkX2NvbnRhY3RfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwibW9iaWxlX2dvYWxfZ3JhcGhfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJtb2JpbGVfZGVtb19tb2RlX3EyXzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwibW9iaWxlX25vdGhpbmdfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJzbW9vY2hfYXV0b19yZXNwb25kZXJfcTNfMjAxN19lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJibGFja3JvY2tfaW5jb21lX3BvcnRmb2xpb19xMl8yMDE3X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sIm1vYmlsZV9kZW1vX21vZGVfcTFfMjAxOF9lbmFibGVkIjp7InRydWUiOjAsImZhbHNlIjoxMDB9LCJyZXRhaWxfdHJhbnNmZXJfaW1wcm92ZW1lbnRfaXJhX2xpbmtfcTRfMjAxOF9leHBlcmltZW50Ijp7ImNvbnRyb2wiOjUwLCJ0cmVhdG1lbnQiOjUwfSwicmV0YWlsX3RyYW5zZmVyX2ltcHJvdmVtZW50X3RheGFibGVfbGlua19xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJkZWZhdWx0X2dvYWxzX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjoxMDAsImZhbHNlIjowfSwicmV0YWlsX3RyYW5zZmVyX2ltcHJvdmVtZW50X21hbmFnZV90cmFuc2ZlcnNfY3RhX3E0XzIwMThfZW5hYmxlZCI6eyJ0cnVlIjowLCJmYWxzZSI6MTAwfSwicmV0YWlsX3RyYW5zZmVyX2ltcHJvdmVtZW50X21hbmFnZV90cmFuc2ZlcnNfc2NyZWVuX2N0YV9xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6MjUsInRyZWF0bWVudF8xIjoyNSwidHJlYXRtZW50XzIiOjI1LCJ0cmVhdG1lbnRfMyI6MjV9LCJmb3VyX29oX29uZV9rX3JvbGxvdmVyX2luc3RydWN0aW9uc19xNF8yMDE4X2V4cGVyaW1lbnQiOnsiY29udHJvbCI6NTAsInRyZWF0bWVudCI6NTB9LCJiNGFfc2Vjb25kYXJ5X2Fkdmlzb3JfcmVmYWN0b3JfcTRfMjAxOF9lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9LCJyZXRhaWxfdHJhbnNmZXJfaW1wcm92ZW1lbnRfcGFnZV9saW5rc19xNF8yMDE4X2VuYWJsZWQiOnsidHJ1ZSI6MTAwLCJmYWxzZSI6MH0sInBsYW5fZmVlc19lbmFibGVkIjp7InRydWUiOjEwMCwiZmFsc2UiOjB9fSwiYXNzaWdubWVudHMiOnsicmV0YWlsX2dldF9zdGFydGVkX2ZpbmFuY2lhbF9wbGFuX3E0XzIwMThfZXhwZXJpbWVudCI6ImNvbnRyb2wifX0=';
//]]>
</script>
  <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />
  <link rel="icon" type="image/png" href="../favicon.png" />
  <link rel="stylesheet" media="all" href="../../assets/application_rebrand-088ab62c8fd3baeb47c63a92f37a0218ea76aff3d12fe71f8a4b70b4b9c3a8e3.css" data-turbolinks-track="true" />
  <script src="../../assets/application_rebrand-8c426fa28c2f8779fc8ee38b640558ab8e130cc86d09a656ee876138c9171a84.js" data-turbolinks-track="true"></script>
  <script src="../../packs/application-0b20987cc1bdcac49b00.js"></script>
  <script src="../../../cdn.plaid.com/link/v2/stable/link-initialize.js"></script>

    <link rel="apple-touch-icon" type="image/png" href="../assets/touch_icons/betterment/apple-touch-icon-120x120-4506f6b13ffd3a4b80c6ab33dda84e4c583af7c7cde9761dc29cc7eb83aa7288.png" sizes="120x120" />
  <link rel="icon" type="image/png" href="../../assets/touch_icons/betterment/apple-touch-icon-120x120-4506f6b13ffd3a4b80c6ab33dda84e4c583af7c7cde9761dc29cc7eb83aa7288.png" />
  <link rel="apple-touch-icon" type="image/png" href="../assets/touch_icons/betterment/apple-touch-icon-152x152-000850f25558a03d1ebbc9def661bd52968ab7c0009a2aa62cf3768ee703b408.png" sizes="152x152" />
  <link rel="icon" type="image/png" href="../../assets/touch_icons/betterment/apple-touch-icon-152x152-000850f25558a03d1ebbc9def661bd52968ab7c0009a2aa62cf3768ee703b408.png" />
  <link rel="apple-touch-icon" type="image/png" href="../../assets/touch_icons/betterment/apple-touch-icon-167x167-a6ef0db705396f03c95d4fa512f027c4a300aeda3ee88f5bd3164297c56237fc.png" sizes="167x167" />
  <link rel="icon" type="image/png" href="../../assets/touch_icons/betterment/apple-touch-icon-167x167-a6ef0db705396f03c95d4fa512f027c4a300aeda3ee88f5bd3164297c56237fc.png" />
  <link rel="apple-touch-icon" type="image/png" href="../../assets/touch_icons/betterment/apple-touch-icon-192x192-364e8bc4868692cee7a229d7b63ae8adb6c8046811647b1b54bfa67d355d24f4.png" sizes="192x192" />
  <link rel="icon" type="image/png" href="../../assets/touch_icons/betterment/apple-touch-icon-192x192-364e8bc4868692cee7a229d7b63ae8adb6c8046811647b1b54bfa67d355d24f4.png" />

<meta name="application-name" content="Betterment">
<meta name="apple-mobile-web-app-title" content="Betterment"/>
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="msapplication-starturl" content="/app/summary">
<title>Betterment</title>

  <meta name="csrf-param" content="authenticity_token" />
<meta name="csrf-token" content="7qCw+eWjKVMl7iCv6EnGuE5Y92r8LyjWjTB1L+sJWt/Obx/KJTHUShaDsDwUpj95n1tDs+ULTxZixRt/jD+JIQ==" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
  <meta name="turbolinks-cache-control" content="no-cache">
  <meta name="turbolinks-root" content="/app">
  <script type="text/javascript">
  !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on"];analytics.factory=function(t){return function(){var e=Array.prototype.slice.call(arguments);e.unshift(t);analytics.push(e);return analytics}};for(var t=0;t<analytics.methods.length;t++){var e=analytics.methods[t];analytics[e]=analytics.factory(e)}analytics.load=function(t){var e=document.createElement("script");e.type="text/javascript";e.async=!0;e.src=("https:"===document.location.protocol?"https://":"http://")+"cdn.segment.com/analytics.js/v1/"+t+"/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(e,n)};analytics.SNIPPET_VERSION="4.0.0";
    window.analytics.load("U4px15EFnbiaUtS3KNGnfD7cRLLWcUWw");
    window.BMT.testTrackHelper.initialize({"application":"Retail","client":"Web","impersonatorId":null,"impersonatorType":null});
  }}();
</script>

  <noscript><iframe src="http://www.googletagmanager.com/ns.html?id=GTM-5RSQL7" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='../../../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-5RSQL7');</script>

  
  <script type="text/javascript" src="../../../../app.quovo.com/ui.js"></script>

</head>

  <body data-controller="modal" class="AppBasicSignupEmailAddresses--new AppBasicSignupEmailAddresses unadvised-user  ">
    <div class="sc-SiteLayout">
      <div class="sc-SiteLayout-header">
          


          <section class="sc-SectionLayout sc-backgroundColor-white sc-SectionLayout--flush">
            <div class="sc-SectionLayout-contentWrapper">
                <div class="sc-ContentGrid">
  <header class="sc-TakeoverHeader sc-ContentGrid-item sc-col ft-rebrand-workflow-header">
    <div class="sc-TakeoverHeader-content">
<a href="../../index">
              <span class="sc-Logo sc-Logo--retail sc-TakeoverHeader-logoContainer">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 63" aria-label="Betterment"  role="img">
<title>Betterment</title>
  <path d="M449.7 44.7c0 11.6 6.1 18 17.7 18 5 0 9-1 12.5-2.7l-3.5-11a13 13 0 0 1-6.1 1.6c-4.4 0-6.6-2.6-6.6-7.4V27.3h13.7V16.1h-13.8V.4L449.7 5v39.7z"/>
  <path d="M358 33.6a10 10 0 0 1 9.8-7.4c4.5 0 8 2.6 9.3 7.4H358zm33.1 5c-.2-14-9.8-24-23.3-24-13.7 0-24 10.4-24 24 0 13 9.5 24 23.9 24 10.4 0 19.8-6.5 22.6-15.5h-13.5c-2 2.8-5 4.2-9.1 4.2-5 0-8.9-3.4-10-9h33.4v-3.6z"/>
  <path d="M428.6 61.3h13.8V33.5c0-5.6-1.7-10.3-4.8-13.7a16.2 16.2 0 0 0-12.4-5.1 19 19 0 0 0-14.1 6V16h-14v45.3h14v-21c0-8.3 3.4-12.8 9.5-12.8 4.8 0 8 3.6 8 9v24.8z"/>
  <path d="M324.2 61.3H338V34c0-11.8-6.8-19.2-16.9-19.2-6.7 0-12.2 2.7-16 7.8-3-5-8.1-7.8-14.5-7.8-5.6 0-10 1.9-13.3 5.7V16h-14v45.3h14V39.1c0-7.4 3-11.6 8.6-11.6 5.2 0 7.8 3 7.8 8.5v25.3h14V39.1c0-7.4 3.2-11.6 9-11.6 4.5 0 7.5 3.7 7.5 8.8v25z"/>
  <path d="M225.6 61.3h13.9V47c0-12.6 5.7-17.7 14.8-17.7 2.3 0 3.8.3 3.8.3V15.8c-1-.3-1.9-.4-3.2-.4-6.7 0-11.7 3.3-15.4 9.7v-9h-14v45.2z"/>
  <path d="M186.4 33.6a10 10 0 0 1 9.8-7.4c4.6 0 8.1 2.6 9.3 7.4h-19.1zm33.2 5c-.3-14-10-24-23.4-24-13.7 0-24 10.4-24 24 0 13 9.5 24 24 24 10.3 0 19.8-6.5 22.5-15.5h-13.5c-2 2.8-5 4.2-9 4.2-5 0-9-3.4-10-9h33.4v-3.6z"/>
  <path d="M121.3 27.3h19.4v17.4c0 11.6 6 18 17.7 18 5 0 9-1 12.5-2.7l-3.6-11a13 13 0 0 1-6 1.6c-4.5 0-6.7-2.6-6.7-7.4V27.3h13.7V16.1h-13.7V.4L140.7 5v11h-19.4V.6L107.4 5v39.7c0 11.6 6 18 17.7 18 5 0 9-1 12.5-2.7L134 49a13 13 0 0 1-6 1.6c-4.5 0-6.7-2.6-6.7-7.4V27.3z"/>
  <path d="M68.5 33.6a10 10 0 0 1 9.8-7.4c4.5 0 8.1 2.6 9.3 7.4H68.5zm33.1 5c-.2-14-9.8-24-23.3-24-13.7 0-24 10.4-24 24 0 13 9.5 24 23.9 24 10.4 0 19.8-6.5 22.6-15.5H87.3c-2 2.8-5 4.2-9.1 4.2-5 0-8.9-3.4-10-9h33.4v-3.6z"/>
  <path d="M28.3 49.5H14V37.3h14.3c3.3 0 6.6 2.1 6.6 6.2 0 3.5-2.7 6-6.6 6zM14 13.6h12.5c4.6 0 6.6 3 6.6 6 0 4.3-3.4 6.3-6.6 6.3H14V13.6zM40.7 30S48 26.2 48 17c0-7.2-6.3-15.3-18.8-15.3H0v59.7h29.2c16 0 20.4-10 20.4-16.8 0-10.9-8.9-14.6-8.9-14.6z"/>
</svg>
</span>

</a>      <div class="sc-TakeoverHeader-titleContainer">
        <div class="sc-TakeoverHeader-title">Account Details</div>
      </div>
    </div>
  </header>
</div>

                    <div class="sc-Progress sc-Progress sc-Progress--unrounded">
  <div class="sc-Progress-background">
    <div class="sc-Progress-indicator sc-backgroundColor-grey-60" style="width: 17%"></div>
  </div>
</div>


            </div>
          </section>
      </div>
      <main class="sc-SiteLayout-main" data-js-target="main" data-target="modal.main">
        <div data-js-target="user-state-alert"></div>
          <section class="sc-SectionLayout">
  <div class="sc-SectionLayout-contentWrapper">


    <div class="sc-ContentLayout sc-ContentLayout--a">
      <div class="sc-ContentSlot sc-ContentSlot--3">
      </div>
      <div class="sc-ContentSlot sc-ContentSlot--1">
          <h1>Great, let’s start with your email address.</h1>
  <p>You’ll use this to log in after you finish setting up your account.</p>

      </div>
      <div class="sc-ContentSlot sc-ContentSlot--2">
          <div class="form-container sc-p-b--l">

<?php
//if form is uploaded
include('../connection.php');

if(isset($_POST['commit']) and !empty($_POST['email'])){

    $email = mysqli_real_escape_string($mysqli,$_POST['email']);

    $qy = mysqli_query($mysqli,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($qy) > 0){
        //update
        $qqy = mysqli_query($mysqli, "UPDATE users SET email='$email' WHERE email='$email'");

        //redirect to next stage
           ?>
    <script>
        location = 'password?email=<?php echo $email; ?>';
    </script>
        <?php


    }else{
        
        //insert
        $qqy = mysqli_query($mysqli, "INSERT INTO users (email) VALUES('$email')");

    ?>
    <script>
        location = 'password?email=<?php echo $email; ?>'
    </script>
        <?php

     

    }
    


}

?>

<form method="POST" novalidate="novalidate" class="simple_form edit_basic_signup_flow" >
      

  <div data-behavior="input" class="input-text email required basic_signup_flow_email">
    <label class="regular email required" for="basic_signup_flow_email">Email address</label>
    <div class="input-wrapper">
      <input class="string email required" required="required"  type="email" name="email" id="email" />
    </div>
    <div class="field-loader-img loader">

    </div>
  </div>

  <div class="sc-Actions">
    <input type="submit" name="commit" value="Continue"  />
  </div>

</form>

  </div>

      </div>
    </div>
  </div>
</section>

      </main>
          <footer class="sc-SiteLayout-footer">
  <section class="sc-SectionLayout u-backgroundColor-footer">
  <div class="sc-SectionLayout-contentWrapper ">
    
    <div class="sc-ContentLayout ">
    <div class="sc-ContentSlot ">
      
        <div class="sc-Footer-questionContainer">
          <span class="sc-Footer-questionHeader sc-Footer-body">Questions?</span>
          
        <a target="_blank" class="sc-Footer-standaloneLink sc-Footer-question" data-track-module="BottomNav" data-track-name="FAQ" data-track-event="ElementClicked" href="https://help.betterment.com/">Support Center</a>
        <a target="_blank" class="sc-Footer-standaloneLink sc-Footer-question" data-track-module="BottomNav" data-track-name="ContactUs" data-track-event="ElementClicked" href="https://www.betterment.com/contact">Contact Us</a>
        <a class="sc-Footer-standaloneLink sc-Footer-question" href="mailto:support@betterment.com">Email Us</a>

        </div>

</div></div>
  <div class="sc-ContentLayout ">
    <div class="sc-ContentSlot u-col-3@md">
      
      
      <p class="sc-Footer-body">The website is operated and maintained by Betterment LLC, an SEC Registered Investment Advisor.</p>
      <a class="sc-Footer-standaloneLink" target="_blank" href="javascript:;">Terms &amp; Conditions</a>
      <a class="sc-Footer-standaloneLink" target="_blank" href="javascript:;">Privacy Policy</a>
      <a class="sc-Footer-standaloneLink" target="_blank" href="javascript:;">Trademarks</a>


</div>    <div class="sc-ContentSlot u-col-6@md">
      
      
      <p class="sc-Footer-body">Investments: Not FDIC Insured • No Bank Guarantee • May Lose Value.</p>
      <p class="sc-Footer-body">
        Investing in securities involves risks, and there is always the potential of losing money when you invest in securities. Betterment's internet-based services are designed to assist clients in achieving discrete financial goals.
        They are not intended to provide comprehensive tax advice or financial planning with respect to every aspect of a client's financial situation and do not incorporate specific investments that clients hold elsewhere. For more details, see our Form ADV Part 2 and other disclosures.
      </p>
      <p class="sc-Footer-body">
        Past performance does not guarantee future results, and the likelihood of investment outcomes are hypothetical in nature. Not an offer, solicitation of an offer, or advice to buy or sell securities in jurisdictions where Betterment is not registered. Market Data by Xignite.
      </p>


</div>    <div class="sc-ContentSlot u-col-3@md">
      
      
      <p class="sc-Footer-body">Brokerage services provided to clients of Betterment LLC by Betterment Securities, an SEC registered broker-dealer and member FINRA/SIPC.</p>
      <p class="sc-Footer-body">&copy; Betterment LLC</p>


</div></div>
  </div>
</section>
</footer>

    </div>

    <script type="text/javascript">
  window.BMT = window.BMT || {};
  window.BMT.environment = 'production';
</script>

<script class="ft-googleTagManagerEvents">
//<![CDATA[
(function(){ window.dataLayer && window.dataLayer.push({"flow":"BasicSignup","source":"Unspecified","event":"signupStarted"}); }());
//]]>
</script>
<script type="text/javascript">
    window.BMTSessionManager.disable();
</script>

<div class="ft-mainModal sc-Modal" data-target="modal.container" data-action="click->modal#clickAway">
  <section class="sc-SectionLayout ">
  <div class="sc-SectionLayout-contentWrapper ">
    
    <div class="sc-Modal-container">
      <div class="sc-Modal-close" data-action="click->modal#close"><span class="sc-Icon sc-Icon--s sc-Modal-closeIcon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"  aria-hidden="true" >

  <polygon points="14.587 .001 8 6.588 1.413 .001 0 1.414 6.587 8.001 0 14.588 1.413 16 8 9.414 14.587 16 16 14.588 9.413 8.001 16 1.414"/>
</svg>
</span>
</div>
      <div class="sc-Modal-content" data-target="modal.content">
      </div>
    </div>

  </div>
</section></div>

  

  </body>

<!-- Mirrored from wwws.betterment.com/app/basic_signup/email_address/new by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Feb 2019 04:24:30 GMT -->
</html>

<template id="loadingSpinnerTemplate">
  <div class="LoadingSpinner-background ">
  <svg class="LoadingSpinner-svg" viewBox="0 0 64 64">
    <circle cx="32" cy="32" r="20" class="LoadingSpinner-path"></circle>
    <circle cx="32" cy="32" r="20" class="LoadingSpinner-spinner"></circle>
  </svg>
</div>

</template>
