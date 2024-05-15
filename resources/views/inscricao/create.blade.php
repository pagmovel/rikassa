@extends('layouts.rikassa')
@section('title', 'Formulário de Inscrição')
@section('content')
    <x-menu />
    <div class="">
        <div class="row">
            <h2 class="mb-5 text-center titulo">Formulário de Inscrição</h2>
        </div>

        <div class="row g-3">

            <form id="FormInscricao" class="mx-auto mb-3 col-md-6 form-floating" action="{{ route('inscricao.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}" id="floatingInput1" placeholder="Nome" required>
                            <label for="floatingInput1">Nome Completo</label>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="floatingInput2" placeholder="email@domimnio.com" required>
                            <label for="floatingInput2">Endereço de e-mail</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" value="{{ old('whatsapp') }}" id="floatingWhatsapp" placeholder="+55 71 99999-9999" required>
                            <label for="floatingWhatsapp">Nº Whatsapp</label>
                            @error('whatsapp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="date" name="nascimento" class="form-control @error('nascimento') is-invalid @enderror" value="{{ old('nascimento') }}" id="floatingDataNascimento" placeholder="+55 71 99999-9999" required>
                            <label for="floatingDataNascimento">Data de Nascimento</label>
                            @error('nascimento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="altura" class="form-control @error('altura') is-invalid @enderror" value="{{ old('altura') }}" id="floatingAltura" placeholder="1,85" required>
                            <label for="floatingAltura">Altura</label>
                            @error('altura')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="cidade" class="form-control @error('cidade') is-invalid @enderror" value="{{ old('cidade') }}" id="floatingCidade" placeholder="Salvador" required>
                            <label for="floatingCidade">Cidade</label>
                            @error('cidade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <select name="estado" class="form-control @error('cidade') is-invalid @enderror" id="floatingEstado" placeholder="BA" required>
                                <option ></option>
                                <option value="Acre" {{ old('estado') == 'Acre' ? 'selected' : '' }}>Acre</option>
                                <option value="Alagoas" {{ old('estado') == 'Alagoas' ? 'selected' : '' }}>Alagoas</option>
                                <option value="Amapá" {{ old('estado') == 'Amapá' ? 'selected' : '' }}>Amapá</option>
                                <option value="Amazonas" {{ old('estado') == 'Amazonas' ? 'selected' : '' }}>Amazonas</option>
                                <option value="Bahia" {{ old('estado') == 'Bahia' ? 'selected' : '' }}>Bahia</option>
                                <option value="Ceará" {{ old('estado') == 'Ceará' ? 'selected' : '' }}>Ceará</option>
                                <option value="Distrito Federal" {{ old('estado') == 'Distrito Federal' ? 'selected' : '' }}>Distrito Federal</option>
                                <option value="Espírito Santo" {{ old('estado') == 'Espírito Santo' ? 'selected' : '' }}>Espírito Santo</option>
                                <option value="Goiás" {{ old('estado') == 'Goiás' ? 'selected' : '' }}>Goiás</option>
                                <option value="Maranhão" {{ old('estado') == 'Maranhão' ? 'selected' : '' }}>Maranhão</option>
                                <option value="Mato Grosso" {{ old('estado') == 'Mato Grosso' ? 'selected' : '' }}>Mato Grosso</option>
                                <option value="Mato Grosso do Sul" {{ old('estado') == 'Mato Grosso do Sul' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                <option value="Minas Gerais" {{ old('estado') == 'Minas Gerais' ? 'selected' : '' }}>Minas Gerais</option>
                                <option value="Pará" {{ old('estado') == 'Pará' ? 'selected' : '' }}>Pará</option>
                                <option value="Paraíba" {{ old('estado') == 'Paraíba' ? 'selected' : '' }}>Paraíba</option>
                                <option value="Paraná" {{ old('estado') == 'Paraná' ? 'selected' : '' }}>Paraná</option>
                                <option value="Pernambuco" {{ old('estado') == 'Pernambuco' ? 'selected' : '' }}>Pernambuco</option>
                                <option value="Piauí" {{ old('estado') == 'Piauí' ? 'selected' : '' }}>Piauí</option>
                                <option value="Rio de Janeiro" {{ old('estado') == 'Rio de Janeiro' ? 'selected' : '' }}>Rio de Janeiro</option>
                                <option value="Rio Grande do Norte" {{ old('estado') == 'Rio Grande do Norte' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                <option value="Rio Grande do Sul" {{ old('estado') == 'Rio Grande do Sul' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                <option value="Rondônia" {{ old('estado') == 'Rondônia' ? 'selected' : '' }}>Rondônia</option>
                                <option value="Roraima" {{ old('estado') == 'Roraima' ? 'selected' : '' }}>Roraima</option>
                                <option value="Santa Catarina" {{ old('estado') == 'Santa Catarina' ? 'selected' : '' }}>Santa Catarina</option>
                                <option value="São Paulo" {{ old('estado') == 'São Paulo' ? 'selected' : '' }}>São Paulo</option>
                                <option value="Sergipe" {{ old('estado') == 'Sergipe' ? 'selected' : '' }}>Sergipe</option>
                                <option value="Tocantins" {{ old('estado') == 'Tocantins' ? 'selected' : '' }}>Tocantins</option>
                                <option value="Estrangeiro" {{ old('estado') == 'Estrangeiro' ? 'selected' : '' }}>Estrangeiro</option>
                            </select>                            
                            <label for="floatingEstado">Estado</label>
                            @error('estado')
                                <div class="erro-estado">{{ $message }}</div>
                            @enderror
                        </div>                        
                    </div>
                    
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="bairro" class="form-control @error('bairro') is-invalid @enderror" value="{{ old('bairro') }}" id="floatingBairro" placeholder="Pituba" required>
                            <label for="floatingBairro">Bairro onde mora</label>
                            @error('bairro')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}" id="floatingFoto" placeholder="" required>
                            <label for="floatingFoto">Foto recente</label>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="profissao" class="form-control @error('profissao') is-invalid @enderror" value="{{ old('profissao') }}" id="floatingProfissao" placeholder="Modelo" required>
                            <label for="floatingProfissao">Profissão</label>
                            @error('profissao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="idiomas" class="form-control @error('idiomas') is-invalid @enderror" value="{{ old('idiomas') }}" id="floatingIdiomas" placeholder="Português" required>
                            <label for="floatingIdiomas">Idiomas falados</label>
                            @error('idiomas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="nacionalidade" class="form-control @error('nacionalidade') is-invalid @enderror" value="{{ old('nacionalidade') }}" id="floatingNacionalidade" placeholder="Brasileira" required>
                            <label for="floatingNacionalidade">Nacionalidade</label>
                            @error('nacionalidade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="interesses_pessoais" class="form-control @error('interesses_pessoais') is-invalid @enderror" value="{{ old('interesses_pessoais') }}" id="floatingInteresses" placeholder="Viajar" required>
                            <label for="floatingInteresses">Interesses pessoais</label>
                            @error('interesses_pessoais')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <input type="text" name="experiencia_previa" class="form-control @error('experiencia_previa') is-invalid @enderror" value="{{ old('experiencia_previa') }}" id="floatingExperienciaPrevia" placeholder="Nenhuma" required>
                            <label for="floatingExperienciaPrevia">Experiência prévia em concursos</label>
                            @error('experiencia_previa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">                    
                        <div class="mb-3 form-floating">
                            <input type="text" name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram') }}" id="floatingInstagram" placeholder="@rikassa" required>
                            <label for="floatingInstagram">Instagram</label>
                            @error('instagram')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">                    
                        <div class="mb-3 form-floating">
                            <input type="text" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook') }}" id="floatingFacebook" placeholder="@rikassa" >
                            <label for="floatingFacebook">Facebook</label>
                            @error('facebook')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">                    
                        <div class="mb-3 form-floating">
                            <input type="text" name="x_twitter" class="form-control @error('x_twitter') is-invalid @enderror" value="{{ old('x_twitter') }}" id="floatingX" placeholder="@rikassa" >
                            <label for="floatingX">X (twitter)</label>
                            @error('x_twitter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="col-md-12">
                        <div class="mb-3 form-floating">
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="concordo" class="form-check-input @error('concordo') is-invalid @enderror" value="1" id="validationFormCheck1" required>
                                <label class="form-check-label" for="validationFormCheck1">Entendo que minha inscrição para o Concurso Rikassa será efetivada somente após o pagamento da taxa de inscrição.</label>
                                @error('concordo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!---  MODAL  -->
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                
                                
                                
                                
                                <div class="modal-body texto">
                                    <div class="mb-4 text-center">
                                        <img src="{{ env('APP_LOGO') }}" alt="logo_rikassa" width="" class="mx-auto img-fluid">
                                    </div>

                                    <h1 class="text-center modal-title fs-5 texto" id="exampleModalLabel">SOBRE A TAXA DE INSCRIÇÂO</h1>
                                    
                                    <p class="mt-4">Para a taxa de inscrição do concurso, você pode escolher entre duas opções de pagamento.</p>

                                    <ul>
                                        <li><p class="text-justify">A primeira é através de transferência via PIX, utilizando os dados bancários que fornecemos. Certifique-se de incluir seu nome completo e o propósito do pagamento na descrição da transferência, para facilitar a confirmação da sua inscrição.<br>Banco: 336 - Banco C6 S.A.
                                            <br>Agência: 0001
                                            <br>Conta Corrente: 6151918-9
                                            <br>Chave PIX: c0935cd5-d74c-4439-be4d-d474e5073881</p></li>
                                            
                                        <li><p class="text-justify">A segunda opção é o pagamento via cartão de crédito, que pode ser feito de forma segura através de nossa plataforma de pagamento online. Após realizar o pagamento, por favor envie o comprovante para nosso e-mail de contato. Isso nos permitirá confirmar sua inscrição e garantir sua participação no concurso. Caso tenha dúvidas ou precise de assistência durante o processo de pagamento, não hesite em entrar em contato conosco.</p></li>
                                    </ul>
                                    

                                    
                                    
                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn btn-primary" id="btn_enviar" onclick="submitForm()">Enviar Inscrição</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---  FIM MODAL  -->

                    <div class="col-md-12">
                        <div class="gap-2 d-grid">
                            <button type="button" class="mb-3 btn btn-primary md-12" data-bs-toggle="modal" data-bs-target="#exampleModal">Clique Aqui Continuar a Inscrição</button>
                        </div>
                    </div>
                    
                </div>
            </form>
            
            
        </div>
    </div>
    
    @push('scripts')
        <script src="https://unpkg.com/imask"></script>
        <script>
            // whatsapp
            const whatsapp = document.getElementById('floatingWhatsapp');
            const maskWhatsappOptions = {
                mask: '+{55} (00) 00000-0000'
            };
            var mask = IMask(whatsapp, maskWhatsappOptions);


            // floatingAltura
            const altura = document.getElementById('floatingAltura');
            const maskAlturaOptions = {
                mask: '{0,00}'
            };
            var mask = IMask(altura, maskAlturaOptions);


            document.addEventListener('DOMContentLoaded', function() {
                // Seleciona o elemento input do tipo date
                const inputDate = document.querySelector('input[type="date"]');

                // Define o evento onclick para o input
                inputDate.onclick = function() {
                    // Simula um clique para abrir o calendário nativo do navegador
                    inputDate.click();
                };

                // Impede que o usuário digite no campo
                inputDate.onkeydown = function(event) {
                    event.preventDefault();
                };

                // Impede que o usuário cole no campo
                inputDate.onpaste = function(event) {
                    event.preventDefault();
                };
            });

        </script>

        

        <script>
            function submitForm() {
                var form = document.getElementById('FormInscricao');
                if (form) {
                    document.getElementById('btn_enviar').disabled = true;
                    form.submit();
                } else {
                    console.error('Formulário não encontrado!');
                }
            }
        </script>
    @endpush
@endsection