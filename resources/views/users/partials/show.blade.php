<section id="basic">
    {!!
        DataRender::render([
            ['label'=>'#', 'value'=>$userObj->code],
            ['label'=>trans('users.labels.name'), 'value'=>$userObj->name],
            ['label'=>trans('users.labels.email'), 'value'=>$userObj->email],
            ['label'=>trans('users.labels.birthdate'), 'value'=>$userObj->birthdate]
        ])
    !!}
</section>