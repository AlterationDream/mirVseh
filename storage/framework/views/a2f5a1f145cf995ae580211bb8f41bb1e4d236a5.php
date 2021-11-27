<td class="vertical-align-middle">
    <input type="text" required class="form-control txtFieldName width-100"/>
    <input type="text" class="form-control foreignTable txtForeignTable display-none"
           placeholder="Foreign table,Primary key"/>
</td>
<td class="vertical-align-middle">
    <select class="form-control txtdbType width-100">
        <option value="increments"><?php echo e(__('app.increments')); ?></option>
        <option value="integer"><?php echo e(__('app.integer')); ?></option>
        <option value="smallInteger"><?php echo e(__('app.smallInteger')); ?></option>
        <option value="longText"><?php echo e(__('app.longText')); ?></option>
        <option value="bigInteger"><?php echo e(__('app.bigInteger')); ?></option>
        <option value="double"><?php echo e(__('app.double')); ?></option>
        <option value="float"><?php echo e(__('app.float')); ?></option>
        <option value="decimal"><?php echo e(__('app.decimal')); ?></option>
        <option value="boolean"><?php echo e(__('app.boolean')); ?></option>
        <option value="string" selected><?php echo e(__('app.string')); ?></option>
        <option value="char"><?php echo e(__('app.char')); ?></option>
        <option value="text"><?php echo e(__('app.text')); ?></option>
        <option value="mediumText"><?php echo e(__('app.mediumText')); ?></option>
        <option value="enum"><?php echo e(__('app.enum')); ?></option>
        <option value="binary"><?php echo e(__('app.binary')); ?></option>
        <option value="dateTime"><?php echo e(__('app.dateTime')); ?></option>
        <option value="date"><?php echo e(__('app.date')); ?></option>
        <option value="timestamp"><?php echo e(__('app.timestamp')); ?></option>
    </select>

    <input type="text" class="form-control dbValue txtDbValue display-none" placeholder=""/>
</td>
<td class="vertical-align-middle">
    <input type="text" class="form-control txtValidation"/>
</td>
<td class="vertical-align-middle">
    <select class="form-control drdHtmlType width-100">
        <option value="text"><?php echo e(__('app.text')); ?></option>
        <option value="email"><?php echo e(__('app.email')); ?></option>
        <option value="number"><?php echo e(__('app.number')); ?></option>
        <option value="date"><?php echo e(__('app.date')); ?></option>
        <option value="file"><?php echo e(__('app.file')); ?></option>
        <option value="password"><?php echo e(__('app.password')); ?></option>
        <option value="select"><?php echo e(__('app.select')); ?></option>
        <option value="radio"><?php echo e(__('app.radio')); ?></option>
        <option value="checkbox"><?php echo e(__('app.checkbox')); ?></option>
        <option value="textarea"><?php echo e(__('app.textarea')); ?></option>
        <option value="toggle-switch"><?php echo e(__('app.toggle')); ?></option>
    </select>
    <input type="text" class="form-control htmlValue txtHtmlValue display-none"
           placeholder=""/>
</td>
<td class="vertical-align-middle">
    <div class="checkbox text-center">
        <label class="pl-0">
            <input type="checkbox" class="flat-red chkPrimary ml-0"/>
        </label>
    </div>
</td>
<td class="vertical-align-middle">
    <div class="checkbox text-center">
        <label class="pl-0">
            <input type="checkbox" class="flat-red chkForeign ml-0"/>
        </label>
    </div>
</td>
<td class="vertical-align-middle">
    <div class="checkbox text-center">
        <label class="pl-0">
            <input type="checkbox" class="flat-red chkSearchable ml-0" checked/>
        </label>
    </div>
</td>
<td class="vertical-align-middle">
    <div class="checkbox text-center">
        <label class="pl-0">
            <input type="checkbox" class="flat-red chkFillable ml-0" checked/>
        </label>
    </div>
</td>
<td class="vertical-align-middle">
    <div class="checkbox text-center">
        <label class="pl-0">
            <input type="checkbox" class="flat-red chkInForm  ml-0" checked/>
        </label>
    </div>
</td>
<td class="vertical-align-middle">
    <div class="checkbox text-center">
        <label class="pl-0">
            <input type="checkbox" class="flat-red chkInIndex ml-0" checked/>
        </label>
    </div>
</td>
<td class="text-center vertical-align-middle">
    <i onclick="removeItem(this)" class="remove fa fa-trash-o field-delete-btn"></i>
</td>
<?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/crud-view/field-template.blade.php ENDPATH**/ ?>