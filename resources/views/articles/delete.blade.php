<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Vymazanie clanku</h4>
            </div>
            <div class="modal-body text-center">
                <p>Chcete naozaj vymazat clanok: {{$articleObj->name}}?</p>
                <form action="{{action('Articles\ArticleController@destroy',[$articleObj->code])}}" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="delete">
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Zrušiť</button>
                    <button type="submit" class="btn btn-danger">Vymazať</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
