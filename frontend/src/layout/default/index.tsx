import { Outlet, useNavigate, Link } from "react-router-dom";
import logo from "../../assets/logocrop.png"
import Swal from "sweetalert2";
import { useContext } from "react";
import { AuthContext } from "../../contexts/Auth/AuthContext";

export default function LayoutDefault() {

    function hiderShowMenu() {
        (window as any).$("#main-wrapper").toggleClass("show-sidebar");
    }

    const auth = useContext(AuthContext);
    const navigate = useNavigate();

    const handleLogout = async () => {
        await auth.logout();
        navigate('/')
        Swal.fire({
            toast: true,
            icon: "success",
            showConfirmButton: false,
            timer: 3000,
            title: 'Deslogado com sucesso.',
            position: 'top-right',
            timerProgressBar: true
        })
    }

    return (
        <div className="page-wrapper show-sidebar" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">
            {/* <!-- Sidebar Start --> */}
            <aside className="left-sidebar">
                {/* <!-- Sidebar scroll--> */}
                <div>
                    <div className="brand-logo d-flex align-items-center justify-content-between">

                        <img src={logo} width="180" alt="" />

                        <div onClick={hiderShowMenu} className="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                            <i className="ti ti-x fs-8"></i>
                        </div>
                    </div>
                    {/* <!-- Sidebar navigation--> */}
                    <nav className="sidebar-nav scroll-sidebar" data-simplebar="">
                        <ul id="sidebarnav">
                            <li className="nav-small-cap">
                                <i className="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span className="hide-menu">Home</span>
                            </li>

                            <li className="sidebar-item">
                                <a className="sidebar-link" href="./index.html" aria-expanded="false">
                                    <span>
                                        <i className="ti ti-layout-dashboard"></i>
                                    </span>
                                    <span className="hide-menu">Dashboard</span>
                                </a>
                            </li>

                        </ul>

                    </nav>
                    {/* <!-- End Sidebar navigation --> */}
                </div>
                {/* <!-- End Sidebar scroll--> */}
            </aside>
            {/* <!--  Sidebar End --> */}
            {/* <!--  Main wrapper --> */}
            <div className="body-wrapper">
                {/* <!--  Header Start --> */}
                <header className="app-header">
                    <nav className="navbar navbar-expand-lg navbar-light">
                        <ul className="navbar-nav">
                            <li className="nav-item d-block d-xl-none">
                                <a className="nav-link sidebartoggler nav-icon-hover" onClick={hiderShowMenu}>
                                    <i className="ti ti-menu-2"></i>
                                </a>
                            </li>
                            <li className="nav-item">
                                <a className="nav-link nav-icon-hover" href="javascript:void(0)">
                                    <i className="ti ti-bell-ringing"></i>
                                    <div className="notification bg-primary rounded-circle"></div>
                                </a>
                            </li>
                        </ul>
                        <div className="navbar-collapse justify-content-end px-0" id="navbarNav">
                            <ul className="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                                <li className="nav-item dropdown">

                                    <a className="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                       
                                        <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" className="rounded-circle" />
                                    </a>
                                    <div className="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                        <div className="message-body">

                                            <a href="javascript:void(0)" className="d-flex align-items-center gap-2 dropdown-item">
                                                <p className="mb-0 fs-3">olá, {auth.user?.fullname}</p>
                                            </a>
                                            <a href="javascript:void(0)" className="d-flex align-items-center gap-2 dropdown-item">
                                                <i className="ti ti-user fs-6"></i>
                                                <p className="mb-0 fs-3">Meu Perfil</p>
                                            </a>

                                            <a onClick={handleLogout} className="btn btn-outline-primary mx-3 mt-2 d-block">sair</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                {/* <!--  Header End --> */}
                <div className="container-fluid">

                    <Outlet />

                    <div className="py-6 px-6 text-center">
                        <p className="mb-0 fs-4">Developed by Jean dos Anjos </p>
                    </div>
                </div>
            </div>
        </div>
    )
}

