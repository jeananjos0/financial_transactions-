
interface IThisfieldRequired {
    fieldError: any;
    msg?: string;
}

export default function ThisfieldRequired({ fieldError, msg = 'Este campo é obrigatório' }: IThisfieldRequired) {
    return (
        fieldError && <span style={{ color: 'red', fontSize: 12 }}>{msg}</span>
    )
}