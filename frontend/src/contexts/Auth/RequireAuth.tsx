import React, { useContext, } from "react";
import Login from "../../pages/login";
import { AuthContext } from "./AuthContext";
import semPerm from '../../assets/svg/undraw_cancel_re_pkdm.svg'


/**
 * Verifica se o usuário tem permissão para acessar a página.
 * @param {JSX.Element} children - Componentes filhos a serem renderizados se o usuário tiver permissão.
 * @param {any[]} role_id - Lista de IDs de função que têm permissão para acessar a página.
 * @returns {JSX.Element} - Retorna o componente Login se o usuário não estiver autenticado, uma mensagem de erro se não tiver permissão ou os componentes filhos se tiver permissão.
 */
export const RequireAuth = ({ children, role_id }: { children: JSX.Element, role_id: any[] }) => {

    const auth = useContext(AuthContext);

    if (!auth.user) {
        setTimeout(function () {
            return <Login />
        }, 500)
    }

    if (auth.user == null) {
        setTimeout(function () {
            return <Login />
        }, 500)
    }


    const RoleFilter = role_id.filter((e: any) => (e === auth.user?.role_id));

    if (RoleFilter.length === 0) {
        return (
            <div style={{ display: 'flex', justifyContent: 'center', alignItems: 'center', flexDirection: 'column' }}>
                <div style={{ display: 'flex', justifyContent: 'center', alignItems: 'center' }}>
                    <img style={{ width: '40%', marginTop: "10%" }} src={semPerm} alt="" />

                </div>
                <br />
            </div>
        );
    }


    return children;

}
