import {
    forwardRef,
    useEffect,
    useImperativeHandle,
    useRef,
    InputHTMLAttributes,
} from "react";

export default forwardRef(function RadioInput(
    {
        id,
        label = "Radio label",
        type = "radio",
        className = "",
        isFocused = false,
        ...props
    }: InputHTMLAttributes<HTMLInputElement> & {
        isFocused?: boolean;
        label: string;
    },
    ref
) {
    const localRef = useRef<HTMLInputElement>(null);

    useImperativeHandle(ref, () => ({
        focus: () => localRef.current?.focus(),
    }));

    useEffect(() => {
        if (isFocused) {
            localRef.current?.focus();
        }
    }, []);

    return (
        <div className="form-check d-flex flex-column align-items-center pl-0">
            <input
                {...props}
                type={type}
                className={
                    "form-check-input w-10 h-10 relative block ml-0" + className
                }
                style={{ position: "relative" }}
                id={id}
                ref={localRef}
            />
            <label className="form-check-label text-center" htmlFor={id}>
                {label}
            </label>
        </div>
    );
});
