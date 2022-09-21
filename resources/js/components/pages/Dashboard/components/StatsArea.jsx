import React, { useCallback, useEffect, useState } from "react";
import useHttp from "../../../../hooks/use-http";
import Loader from "../../../Loader/Loader";
import SalesCard from "./SalesCard";

const StatsArea = () => {
    const [stats, setStats] = useState();
    const transformData = useCallback((result) => setStats(result.data), []);

    const {
        isLoading,
        error,
        sendRequest: fetchStats,
    } = useHttp(transformData);
    useEffect(() => {
        fetchStats({ url: "/api/dashboard/stats/" });
    }, [fetchStats]);

    if (isLoading) {
        return <Loader />;
    }
    if (error) {
        return (
            <div className="container-fluid pt-4 px-4">
                <h2 className="text-center">Error While Fetching Data</h2>
            </div>
        );
    }

    if (!isLoading && stats) {
        return (
            <div className="container-fluid pt-4 px-4">
                <div className="row g-4">
                    <SalesCard
                        title={"Users"}
                        price={stats.users}
                        iconType={"line"}
                    />
                    <SalesCard
                        title={"Todays Bookings"}
                        price={stats.bookings}
                        iconType={"bar"}
                    />

                    <SalesCard
                        title={"Locations"}
                        price={stats.locations}
                        iconType={"area"}
                    />
                    <SalesCard
                        title={"Total Bookings"}
                        price={stats.totalBookings}
                        iconType={"pie"}
                    />
                </div>
            </div>
        );
    }
    return <></>;
};

export default StatsArea;
