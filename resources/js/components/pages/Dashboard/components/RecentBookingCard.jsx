import React, { useCallback, useEffect, useState } from "react";
import useHttp from "../../../../hooks/use-http";
import CardWrapper from "../../../CardWrapper/CardWrapper";
import Loader from "../../../Loader/Loader";

const RecentBookingCard = () => {
    const [recentBookings, setRecentBookings] = useState([]);
    const transformData = useCallback(
        (result) => setRecentBookings(result.data),
        []
    );

    const {
        isLoading,
        error,
        sendRequest: fetchBookings,
    } = useHttp(transformData);
    useEffect(() => {
        fetchBookings({ url: "/api/dashboard/recent-bookings/" });
    }, [fetchBookings]);

    if (isLoading) {
        return <Loader />;
    }

    return (
        <CardWrapper>
            {error && <div className="text-center"> Error While Fetching</div>}
            {recentBookings && (
                <>
                    <div className="d-flex align-items-center justify-content-between mb-4">
                        <h6 className="mb-0">Recent Bookings</h6>
                        <a href="">Show All</a>
                    </div>
                    <div className="table-responsive">
                        <table className="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr className="text-white">
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Patient Name</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                {recentBookings.length == 0 ? (
                                    <tr>
                                        <td colSpan={6} className="text-center">
                                            <strong>No Bookings Found</strong>
                                        </td>
                                    </tr>
                                ) : (
                                    recentBookings.map((booking, index) => (
                                        <tr>
                                            <td>#{index + 1}</td>
                                            <td>{booking.created_date}</td>
                                            <td>{booking.patient_name}</td>
                                            <td>{booking.contact}</td>
                                            <td>{booking.location_id}</td>
                                            <td>{booking.type}</td>
                                        </tr>
                                    ))
                                )}
                            </tbody>
                        </table>
                    </div>
                </>
            )}
        </CardWrapper>
    );
};

export default RecentBookingCard;
