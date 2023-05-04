import { useState, useContext } from "react"
import { useNavigate } from "react-router-dom";
import { AuthContext } from "../../contexts/Auth/AuthContext";
import Logo from "../../assets/logocrop.png"
import Loading from "../../components/loading";
import Swal from "sweetalert2";
import { useForm } from "react-hook-form";
import ThisfieldRequired from "../../components/ThisfieldRequired";

export default function Login() {

    // Importa o contexto de autenticação
    const auth = useContext(AuthContext);
    // Importa o hook de navegação
    const navigate = useNavigate();

    // Configura o hook useForm com valores padrão para email e password
    const { register, handleSubmit, formState: { errors } } = useForm({
        defaultValues: {
            email: '',
            password: ''
        }
    });

    // Cria um estado para gerenciar o carregamento
    const [loading, setLoading] = useState(false);

    // Função assíncrona para lidar com o login
    const handleLogin = async (data: any) => {


        // Verifica se o email e a senha foram fornecidos
        if (data.email && data.password) {
            // Define o estado de carregamento como verdadeiro
            setLoading(true);



            // Chama a função de login do contexto de autenticação
            const isLogged = await auth.login(data.email, data.password).finally(() => {
                // Define o estado de carregamento como falso após o login
                setLoading(false);
            });

            // Se o usuário estiver logado, navega para o dashboard
            if (isLogged) {
                navigate('/dashboard');

                // Exibe uma mensagem de boas-vindas com um temporizador
                Swal.fire({
                    toast: true,
                    icon: "success",
                    showConfirmButton: false,
                    timer: 3000,
                    title: 'Bem vindo(a)',
                    position: 'top-right',
                    timerProgressBar: true
                })
            }
        }
    }

    return (
        <div className="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">
            <div
                className="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
                <div className="d-flex align-items-center justify-content-center w-100">
                    <div className="row justify-content-center w-100">
                        <div className="col-md-8 col-lg-6 col-xxl-3">
                            <div className="card mb-0">
                                <div className="card-body">
                                    <a href="./index.html" className="text-nowrap logo-img text-center d-block py-3 w-100">
                                        <img src={Logo} width="180" alt="" />
                                    </a>
                                    <p className="text-center">Transações Financeiras</p>
                                    <form onSubmit={handleSubmit(handleLogin)}>
                                        <div className="mb-3">
                                            <label htmlFor="inputEmail" className="form-label">E-mail</label>
                                            <input type="email" {...register('email', { required: true })} className="form-control" id="inputEmail" aria-describedby="emailHelp" />
                                            <ThisfieldRequired fieldError={errors.email} />
                                        </div>
                                        <div className="mb-4">
                                            <label htmlFor="inputPassword" className="form-label">Senha</label>
                                            <input type="password" {...register('password', { required: true })} className="form-control" id="inputPassword" />
                                            <ThisfieldRequired fieldError={errors.password} />
                                        </div>

                                        <button type="submit" className="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">

                                            {loading ? <Loading color="white" width={25} height={25} /> : 'Entrar'}

                                        </button>

                                        <div className="text-center p-t-30">
                                            © Developed by Jean dos Anjos
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    )
}


