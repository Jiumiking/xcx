/* add by jinjunming */
/* 斑马线函数*/
 function banmaxian(){
     $(".public_table:first tbody tr:odd").css("backgroundColor","#f1f3f4");
     $(".public_table tr:gt(0)").unbind('mouseenter mouseleave');
     $("#list_content tr").unbind('mouseover mouseout');
 }

function trim( text ) {
  if (typeof(text) == "string"){
    return text.replace(/^\s*|\s*$/g, "");
  }
  else{
    return text;
  }
}

function isInt(val){
	if (val == ""){
    	return false;
  }
  var reg = /\D+/;
  return !reg.test(val);
};

function getEvent(e){
  var evt = (typeof e == "undefined") ? window.event : e;
  return evt;
};

function PageList(url,pageSize){
	this.filter = new Object;
	this.filter['page'] = 1;
	this.pageSize = pageSize;

	this.mUrl = url;

	this.mUrl += "?is_ajax=1";

	/* 构造请求参数 */
	this._bulidFilter = function(objParams){
		if ( objParams == null || typeof objParams != "object" ){
			return null;
		}
		var args = "";
		for (var i in objParams){
			if (typeof objParams[i] != "function" && typeof objParams[i] != "undefined"){
				args += "&" + i + "=" + encodeURIComponent(objParams[i]);
			}
		}
		if (args != ""){
			args = args.substring(1);
		}
		return args;
	};

	/* 切换排序方式 */
	this.sort = function(sort_by, sort_order){
		if (this.filter["sort_by"] == sort_by) {
			this.filter["sort_order"]= ( this.filter["sort_order"] == "DESC" ? "ASC" : "DESC" );
		} else {
			this.filter["sort_by"]    = sort_by;
			this.filter["sort_order"] = "DESC";
		}
		this.mUrl = this._bulidUrl("sort_by", sort_by) + "&sort_order=" + sort_order;
	};

	/* 载入页面 */
	this.loadPage = function(){
        var page = this;
		$.ajax({
			type : "POST",
			async : true,
			url : this.mUrl,
			data : this._bulidFilter(this.filter),
			success : function(msg){
				page.pageCallback(msg);
				banmaxian();
			}
		});
	};

	/* 翻页 */
	this.toPage = function(page){
		if (page != null){
			page = ( page > this.pageCount ? 1 : page );
			this.filter["page"] = page;
		}
		this.filter["page_size"] = this.pageSize;
		this.loadPage();
	};

	/* 首页 */
	this.firstPage = function(){
		if (this.filter["page"] > 1) {
			this.toPage(1);
		}
	};

	/* 末页 */
	this.endPage = function(){
		if (this.filter["page"] < this.pageCount) {
			this.toPage(this.pageCount);
		}
	};

	/* 上一页 */
	this.lastPage = function(){
		if (this.filter["page"] > 1) {
			this.toPage(parseInt(this.filter["page"]) - 1);
		}
	};

	/* 下一页 */
	this.nextPage = function(){
		if (this.filter["page"] < this.pageCount) {
			this.toPage(parseInt(this.filter["page"]) + 1);
		}
	};

	/* 改变页数 */
	this.changePage = function(e, obj){
		var evt = getEvent(e);
		if (evt.keyCode != 13){
			return false;
		}
		
		var page = $(obj).val();
		if ( ! isInt(page) || parseInt(page) > this.pageCount ){
			page = this.filter["page"];
			return false;
		}
		this.toPage(page);
	};

	/* 改变每页显示数 */
	this.changePageSize = function(val){
		this.pageSize = val;
		this.toPage(1);
	};

	/* 回调函数 */
	this.pageCallback = function(result){
		try {
			alert(result);
		} catch (e) {
			alert(e.message);
		}
	};

	/* 获取每页记录数 */
	this.getPageSize = function(){
		var ps = document.getElementById("pageSize").value;
		if (ps) {
			document.cookie = "static[page_size]=" + ps + ";";
		}else{
			ps = 15;
		}
		return ps;
	};
}
