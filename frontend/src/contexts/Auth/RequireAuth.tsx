import React, { useContext } from "react";
import Login from "../../pages/login";
import { AuthContext } from "./AuthContext";
import semPerm from '../../assets/svg/undraw_cancel_re_pkdm.svg'

export const RequireAuth = ({ children, role_id }: { children: JSX.Element, role_id: any[] }) => {

    const auth = useContext(AuthContext);

    if (!auth.user) {
        setTimeout(function () {
            return <Login />
        }, 5000)
    }

    if (auth.user == null) {
        setTimeout(function () {
            return <Login />
        }, 5000)
    }

    const RoleFilter = role_id.filter((e: any) => (e === auth.user?.role_id));

    if (RoleFilter.length === 0) {
        return (
            <div style={{ display: 'flex', justifyContent: 'center', alignItems: 'center', flexDirection: 'column' }}>
                <div style={{ display: 'flex', justifyContent: 'center', alignItems: 'center' }}>
                    <img style={{ width: '40%', marginTop: "90%" }} src={semPerm} alt="" />
                </div>
            </div>
        );
    }


    return children;

}
