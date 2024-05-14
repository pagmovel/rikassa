@extends('layouts.rikassa')
@section('title', 'Confirmacao do Email')
@section('content')


    <div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            p, a {
                font-size: 16px;
                color: #94580A;
            }

            .svg-inline--fa {
                height: 3em !important;
                color: #94580A;
            }

            .cartao {
                font-size: 3pc !important;
                color: #94580A;
            }

            .list-group {
                --bs-list-group-border-color: #f5d9bf !important;
            }
        </style>
        
        <x-menu />

        <h3 class="mt-5 mb-4 titulo">Olá, {{ $dados->nome }}!</h3>
        @if (isset($status))
            <p><strong>Infelizmente o banco rejeitou o pagamento.</strong><br>
            Por favor, tente novamente com outro cartão, ou outro meio de pagamento.</p>
        @else
        <p>Agradecemos por ter confirmado seu e-mail.<br>
            Falta apenas realizar o pagamento para confirmar sua inscrição no concurso.</p>
        @endif
        <br>
        <br>
        
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 titulo">Escolha com deseja realizar seu pagamento</h5>
        </div>
        
        <div class="list-group">
            <a href="#"  data-bs-toggle="modal" data-bs-target="#exampleModal" class="list-group-item list-group-item-action" aria-current="true">
                <div class="row">
                    <div class="">
                        <i class="pt-3 pb-3 fa-brands fa-pix"></i>
                    </div>
                    <div class="col">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 titulo">Pagar com um PIX</h5>
                        </div>
                        <p class="mb-1">Selecionando esta opção, após o pagamento você deverá enviar o comprovante via formulário que abrirá após seleção.</p>
                    </div>
                </div>
            </a>

            <a href="{{ $link_pagamento }}" class="list-group-item list-group-item-action">
                <div class="row">
                    <div class="">
                        <i class="bi bi-credit-card cartao"></i>
                    </div>
                    <div class="col">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 titulo">Pagar co Cartão de Crédito</h5>
                        </div>
                        <p class="mb-1">Selecionando esta opção, uma nova janela do Mercadp Pago abrirá.  Você selecionará como vai pagar.</p>
                    </div>
                </div>
            </a>
        </div>

        
        <form id="FormInscricao" class="mx-auto mb-3 col-md-6 form-floating" action="{{ route('inscricao.store.pix') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    
                    <div class="modal-content">                        
                        <div class="modal-body texto">
                            <div class="mb-4 text-center">
                                <img src="{{ env('APP_LOGO') }}"  alt="logo_rikassa" class="mx-auto img-fluid" width="179" height="74" alt="LOGO RIKASSA">
                            </div>

                            <h1 class="mb-4 text-center modal-title fs-5 texto" id="exampleModalLabel">TAXA DE INSCRIÇÃO VIA PIX</h1>
                            
                            <p class="text-justify">Para transferência via PIX, utilize os dados bancários que forneceremos abaixo: Certifique-se de incluir seu nome completo e o propósito do pagamento na descrição da transferência, para facilitar a confirmação da sua inscrição.</p>

                            <strong><p>Banco: 336 - Banco C6 S.A.
                            <br>Agência: 0001
                            <br>Conta Corrente: 6151918-9
                            <br>Chave PIX: c0935cd5-d74c-4439-be4d-d474e5073881</p></strong>
                            
                            
                            <div class="mt-5 col-md-12">
                                <div class="mb-3 form-floating">
                                    <input type="file" name="comprovante" class="form-control @error('comprovante') is-invalid @enderror" value="{{ old('comprovante') }}" id="floatingcomprovante" placeholder="" required>
                                    <label for="floatingcomprovante">Comprovante PIX</label>

                                    
                                    @error('comprovante')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary" id="btn_enviar">Enviar Comprovante</button>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!---  FIM MODAL  -->
        </form>


    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endpush
@endsection



