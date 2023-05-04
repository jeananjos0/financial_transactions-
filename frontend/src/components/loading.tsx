import loadingb from "../assets/svg/loadingBlack.svg";
import loadingw from "../assets/svg/loadingWhite.svg";

interface ILoading {
    color?: any
    position?: any;
    top?: boolean;
    width?: any;
    height?: any;
}

export default function Loading({ color, top, width = 90, height = 90 }: ILoading) {
    return (
        <div style={{ zIndex: 10000, display: "flex", justifyContent: "center", alignItems: "center", marginTop: top ? 32 : 0 }}>
            {
                color === 'black' ?
                    (<img src={loadingb} width={width} height={height} alt="loading" />) :
                    color === 'white' ?
                        (<img src={loadingw} width={width} height={height} alt="loading" />) :
                        ''
            }
        </div>

    )
}