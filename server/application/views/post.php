<?php include('_header.php'); ?>
			<div class="container">

				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-lg-2 control-label" for="upload_pic">圖片上傳</label>
						<div id="upload_pic" class="col-lg-10">
							<form id="fileupload" action="../upload/do_upload" method="POST" enctype="multipart/form-data">
						        <div class="row fileupload-buttonbar">
						            <div class="col-lg-7">
						                <span class="btn btn-success fileinput-button">
						                    <i class="glyphicon glyphicon-plus"></i>
						                    <span>新增圖片...</span>
						                    <input type="file" name="files" multiple>
						                </span>
						                <button type="submit" class="btn btn-primary start">
						                    <i class="glyphicon glyphicon-upload"></i>
						                    <span>開始上傳</span>
						                </button>
						                <button type="reset" class="btn btn-warning cancel">
						                    <i class="glyphicon glyphicon-ban-circle"></i>
						                    <span>取消上傳</span>
						                </button>
										<span class="fileupload-loading"></span>
						            </div>
						            <div class="col-lg-5 fileupload-progress fade">
						                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
						                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
						                </div>
						                <div class="progress-extended">&nbsp;</div>
						            </div>
						        </div>
						        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
						    </form>
						</div>
					</div>
				</div>

				<form class="form-horizontal" method="POST" role="form" action="<?php echo base_url("index.php/market/insert_product_data"); ?>">
					<div class="form-group">
						<label for="input_title" class="col-lg-2 control-label">商品名稱</label>
		    			<div class="col-lg-5">
		      				<input type="text" class="form-control" name="input_title" id="input_title" placeholder="{{ product_title }}" required>
		    			</div>
					</div>
					<div class="form-group">
						<label for="input_price" class="col-lg-2 control-label">商品價錢</label>
		    			<div class="col-lg-5">
		    				<div class="input-group">
		    					<span class="input-group-addon">$</span>
		      					<input type="text" class="form-control" name="input_price" id="input_price" placeholder="{{ prodcut_price }}" required>
		    				</div>
		    			</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">商品類型</label>
		    			<div class="col-lg-5">
							<select id="product_type" class="form-control" name="input_type" required>
								<option value="二手書籍">二手書籍</option>
								<option value="二手服飾">二手服飾</option>
								<option value="其他類型">其他類型</option>
							</select>
						</div>
					</div>
					<div id="form_course" class="form-group">
						<label for="input_course" class="col-lg-2 control-label">適合課程</label>
		    			<div class="col-lg-5">
		      				<input type="text" class="form-control" name="input_course" id="input_course" placeholder="{{ 適合使用的課程 }}">
		    			</div>
					</div>
					<div class="form-group">
						<label for="input_description" class="col-lg-2 control-label">商品描述</label>
		    			<div class="col-lg-10">
		      				<input type="text" class="form-control" name="input_description" id="input_description" placeholder="{{ product_description }}" required>
		    			</div>
					</div>

		    		<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button type="submit" class="btn btn-danger btn_post">送出</button>
						</div>
					</div>

				</form>	
			</div>
<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
	    <tr class="template-upload fade">
	        <td>
	            <span class="preview"></span>
	        </td>
	        <td>
	            <p class="name">{%=file.name%}</p>
	            {% if (file.error) { %}
	                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
	            {% } %}
	        </td>
	        <td>
	            <p class="size">{%=o.formatFileSize(file.size)%}</p>
	            {% if (!o.files.error) { %}
	                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
	            {% } %}
	        </td>
	        <td>
	            {% if (!o.files.error && !i && !o.options.autoUpload) { %}
	                <button class="btn btn-primary start">
	                    <i class="glyphicon glyphicon-upload"></i>
	                    <span>開始上傳</span>
	                </button>
	            {% } %}
	            {% if (!i) { %}
	                <button class="btn btn-warning cancel">
	                    <i class="glyphicon glyphicon-ban-circle"></i>
	                    <span>取消上傳</span>
	                </button>
	            {% } %}
	        </td>
	    </tr>
	{% } %}
	</script>
	<script id="template-download" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
	    <tr class="template-download fade">
	        <td>
	            <span class="preview">
	                {% if (file.thumbnailUrl) { %}
	                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
	                {% } %}
	            </span>
	        </td>
	        <td>
	            <p class="name">
	                {% if (file.url) { %}
	                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
	                {% } else { %}
	                    <span>{%=file.name%}</span>
	                {% } %}
	            </p>
	            {% if (file.error) { %}
	                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
	            {% } %}
	        </td>
	        <td>
	            <span class="size">{%=o.formatFileSize(file.size)%}</span>
	        </td>
	        <td>
	            {% if (file.deleteUrl) { %}
	                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
	                    <i class="glyphicon glyphicon-trash"></i>
	                    <span>刪除檔案</span>
	                </button>
				{% } else { %}
	                <button class="btn btn-warning cancel">
	                    <i class="glyphicon glyphicon-ban-circle"></i>
	                    <span>取消上傳</span>
	                </button>
	            {% } %}
	        </td>
	    </tr>
	{% } %}
	</script>
<?php include('_footer.php'); ?>