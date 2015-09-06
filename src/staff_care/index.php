<?php $this->beginClip('css');?>
<link href="/static/src/crm/css/task.css" rel="stylesheet" type="text/css" />
<?php $this->endClip();?>
<?php $this->page_title = '短信模板列表';?>
<ol class="breadcrumb">
    <li><a>短信</a></li>
    <li class="active">模板添加</li>
</ol>
<div class="operate">
    <button class="btn btn-warning" id="btnAdd">+添加</button>
    <button class="btn btn-warning" id="btnUpload">↑上传文件</button>
    <span style="color:red;">上传文件不能大于5M</span>
    <div class="pull-right" style="color:red;height:34px; line-height:34px; padding:0 5px;">下载文件为当前执行文件</div>
    <a class="btn btn-warning pull-right" id="btnDownload" id="btnDownload" target="_self" href="/fist/staff_care/down/down_load">下载</a>
    <input type="file" id="uploadFile" name="uploadFile" class="hide" />
</div>

<div class="mainList">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="width:80px;">模板名称</th>
                <th style="width:80px;">模板类型</th>
                <th>模板内容</th>
                <th style="width:80px;">发起人</th>
                <th style="width:150px;">创建时间</th>
                <th style="width:80px;">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data)): ?>
            <?php foreach ($data as $key => $val): ?>
            <tr>
                <td><?php echo $val['subject']?></td>
                <td><?php echo $val['type']?></td>
                <td><?php echo $val['content']?></td>
                <td><?php echo $val['creator_id']?></td>
                <td><?php echo $val['create_time']?></td>
                <td>
                    <button class="btn btn-warning btn-sm edit"  data-id="<?php echo $val['id'];?>">编辑</button>
                </td>
            </tr>
            <?php endforeach;?>
            <?php endif;?>
        </tbody>
    </table>
</div>
</div>
</div>
<div class="modal fade" id="modal" ng-controller="showInfo">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button  type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
        标题
    </div>
    <div class="modal-body">
        <form class="form-horizontal" id="authForm">
            <input type="hidden" name="id" id="id" />
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">类型：</label>
                <div class="col-md-10">
                    <select class="form-control" ng-model="data.type" id="selType">
                        <option value="">请选择</option>
                        <?php foreach (Constant::get_sms_views() as $key => $val): ?>
                        <option value="<?php echo $key?>"><?php echo $val?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="parentDepart" class="col-md-2 control-label" >主题：</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="txtSubject" ng-model="data.subject" />
                </div>
            </div>
            <div class="form-group">
                <label for="remark" class="col-md-2 control-label">内容：</label>
                <div class="col-md-10">
                    <textarea class="form-control"  rows="6" ng-model="data.content"></textarea>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class='btn btn-warning' id="btnSave">保 存</button>
    </div>
</div>
<?php $this->beginClip('javascript');?>
<script type="text/javascript" src="/static/src/base/bower/angular.min.js"></script>
<script type="text/javascript" src="/static/src/base/js/ajaxupload.js"></script>
<script type="text/javascript" src="/static/src/fist/js/sms.js"></script>
<?php $this->endClip();?>