import React from "react";

interface Props {
    color: "primary" | "info" | "success" | "warning" | "danger";
    count: number;
    text: string;
}

const DashboardCard = ({ count, text, color }: Props) => {
    return (
        <div className="col-md-3 mb-3 mb-md-0">
            <div className={"card bg-" + color + " text-white"}>
                <div className="card-body text-center">
                    <h2>{count}</h2>
                    <h6>{text}</h6>
                </div>
            </div>
        </div>
    );
};

export default DashboardCard;
