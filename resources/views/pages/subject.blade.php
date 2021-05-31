@extends('layouts.master')

@section('title', 'Subject')

@section('content')
    <div class="subject-detail">
        <div class="show-card container">
            <h3 class="show-card__title">{{ $subject->name }} ({{ count($expiryCards) }} {{ __('app.due_card') }})</h3>
            <div class="row">
                <!-- Show card right -->
                @include('layouts.subject.right_subject')

                <!-- Show card left -->
                @include('layouts.subject.show_card')
            </div>
        </div>

        <!-- Subject utility -->
        @include('layouts.subject.utility')

        <!-- Show card list -->
        @include('layouts.subject.list_card')

        <!-- Modal -->
        <div class="modal" tabindex="-1" role="dialog" id="testModal">
            <form action="{{ route('sharedSub.create') }}" method="post">
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header test">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>{{ __('app.share_subject') }}</p>
                            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ __('app.yes') }}</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.no') }}</button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
        
    </div>
@endsection

@section('script')

    @if (session()->has('popup'))
        <script>
            $(document).ready(function(){
                
                $("#testModal").modal('show');

            });
        </script>
    @endif

    <script>
        const cards = document.querySelectorAll(".show-card__inner");

        for (let card of cards) {
            card.addEventListener("click", function (e) {
                card.classList.toggle('is-flipped');
            });
        }
        
        var synth = window.speechSynthesis;
        var showCardListItems = document.querySelectorAll('.show-card__list__item');
        for (let item of showCardListItems) {
            let btnSpeak = item.firstElementChild.lastElementChild.firstElementChild;
            let txtBack = item.firstElementChild.firstElementChild.firstElementChild.lastElementChild;
            let btnUpdateCard = btnSpeak.nextElementSibling;
            let cardDetail = item.firstElementChild.firstElementChild.firstElementChild;
            let formUpdateCardWrapper = cardDetail.nextElementSibling;
            let formUpdateCard = cardDetail.nextElementSibling.firstElementChild;

            btnSpeak.addEventListener('click', () => {
                var toSpeak = new SpeechSynthesisUtterance(txtBack.innerText);
                var voice = synth.getVoices()[4];
                toSpeak.voice = voice;
                synth.speak(toSpeak);
            });

            btnUpdateCard.addEventListener('click', function() {
                    this.classList.toggle('focus-color');
                    cardDetail.classList.toggle('un-display');
                    formUpdateCard.classList.toggle('un-display');
                });
        }

        //list
        var editor = document.querySelectorAll('.update_editor');
        for (let i of editor) {
            ClassicEditor
            .create( i, {
                extraPlugins: [ SimpleUploadAdapterPlugin ],
            } )
            .catch( error => {
                console.error( error );
            } );
        }

        class MyUploadAdapter {
        constructor( loader ) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }

        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }

        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();
            xhr.open( 'POST', '{{ route('images.store') }}', true );
            xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
            xhr.responseType = 'json';
        }

        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;
            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;
                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }

                resolve( {
                    default: response.url
                } );
            } );

            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
        }
        _sendRequest( file ) {
            const data = new FormData();
            data.append( 'upload', file );
            this.xhr.send( data );
        }
    }

        function SimpleUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                return new MyUploadAdapter( loader );
            };
        }
        
    </script>
@endsection

