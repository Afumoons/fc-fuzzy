import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Link, Head } from "@inertiajs/react";
import { FuzzyRule, PageProps } from "@/types";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faPenToSquare, faTrashCan } from "@fortawesome/free-regular-svg-icons";
import { useTable, usePagination } from "react-table";
import React from "react";

export default function Index({ auth, isAdmin, disease, logo }: PageProps) {
    function convertData(data: FuzzyRule) {
        // Extract the antecedent object and transform it into the required string format
        const antecedentStr = Object.entries(data.data.antecedent)
            .map(([key, value]) => `${key}${value}`)
            .join("\n");

        // Extract the TingkatKeparahan and format it as a percentage
        const tingkatKeparahan = `${data.data.consequent.TingkatKeparahan}%`;

        // Construct the new object with the required structure
        const newData = {
            col1: data.id,
            col2: antecedentStr,
            col3: tingkatKeparahan,
        };

        return newData;
    }

    // make data array
    let dataArray = [];
    // console.log(disease.fuzzy_rules);

    disease.fuzzy_rules.map((fuzzyRule) => {
        let convertedData = convertData(fuzzyRule);
        dataArray.push(convertedData);
    });
    const data = React.useMemo(() => dataArray, []);

    const columns = React.useMemo(
        () => [
            {
                Header: "No",

                accessor: "col1", // accessor is the "key" in the data
                Cell: ({ row }) => <span>{row.index + 1}</span>,
            },
            {
                Header: "Pilihan",

                accessor: "col2",
                Cell: ({ value }) => {
                    const formattedValue = value
                        .split("\n")
                        .map((line, index) => (
                            <React.Fragment key={index}>
                                {line}
                                <br />
                            </React.Fragment>
                        ));
                    return <div>{formattedValue}</div>;
                },
            },
            {
                Header: "Hasil",

                accessor: "col3",
            },
            {
                Header: "Edit Detail",
                Cell: ({ row }) => (
                    // Use the row.canExpand and row.getToggleRowExpandedProps prop getter
                    // to build the toggle for expanding a row
                    <Link
                        href={route("admin.fuzzy.edit", row.values.col1)}
                        className="mr-2 badge bg-warning text-decoration-none p-2"
                    >
                        <FontAwesomeIcon icon={faPenToSquare} />
                    </Link>
                    //     <Link
                    //     href={route(
                    //         "admin.fuzzy.edit",
                    //         { fuzzyRule }
                    //     )}

                    // >

                    // </Link>
                ),
                // accessor: "col4",
            },
        ],
        []
    );
    const {
        getTableProps,
        getTableBodyProps,
        headerGroups,
        prepareRow,
        page, // Instead of using 'rows', we'll use page,
        // which has only the rows for the active page

        // The rest of these things are super handy, too ;)
        canPreviousPage,
        canNextPage,
        pageOptions,
        pageCount,
        gotoPage,
        nextPage,
        previousPage,
        setPageSize,
        state: { pageIndex, pageSize },
    } = useTable(
        {
            columns,
            data,
            initialState: { pageIndex: 0 },
        },
        usePagination
    );
    // Object.entries(disease.fuzzy_rules[0].data.consequent).forEach(
    //     ([key, value]) => {
    //         console.log(key, value);
    //     }
    // );
    // console.log(disease.fuzzy_rules[0].data.antecedent);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Data Rule Fuzzy
                </h2>
            }
            isAdmin={isAdmin}
            logo={logo}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg row p-6">
                        <div className="col">
                            <h2 className="text-gray-900">Data Rule Fuzzy</h2>
                        </div>
                        <div className="mt-3 col-12 table-responsive">
                            {/* <pre>
                                <code>
                                    {JSON.stringify(
                                        {
                                            pageIndex,
                                            pageSize,
                                            pageCount,
                                            canNextPage,
                                            canPreviousPage,
                                        },
                                        null,
                                        2
                                    )}
                                </code>
                            </pre> */}
                            <table
                                className="table table-bordered table-hover table-striped"
                                {...getTableProps()}
                            >
                                <thead>
                                    {headerGroups.map((headerGroup) => (
                                        <tr
                                            {...headerGroup.getHeaderGroupProps()}
                                        >
                                            {headerGroup.headers.map(
                                                (column) => (
                                                    <th
                                                        {...column.getHeaderProps()}
                                                    >
                                                        {column.render(
                                                            "Header"
                                                        )}
                                                    </th>
                                                )
                                            )}
                                        </tr>
                                    ))}
                                </thead>
                                <tbody {...getTableBodyProps()}>
                                    {page.map((row, i) => {
                                        prepareRow(row);
                                        return (
                                            <tr {...row.getRowProps()}>
                                                {row.cells.map((cell) => {
                                                    return (
                                                        <td
                                                            {...cell.getCellProps()}
                                                        >
                                                            {cell.render(
                                                                "Cell"
                                                            )}
                                                        </td>
                                                    );
                                                })}
                                            </tr>
                                        );
                                    })}
                                </tbody>
                            </table>
                            {/*
                                Pagination can be built however you'd like.
                                This is just a very basic UI implementation:
                            */}
                            <div className="pagination flex align-items-center">
                                <button
                                    className="badge bg-primary p-2 mr-2"
                                    onClick={() => gotoPage(0)}
                                    disabled={!canPreviousPage}
                                >
                                    {"<<"}
                                </button>{" "}
                                <button
                                    className="badge bg-primary p-2 mr-2"
                                    onClick={() => previousPage()}
                                    disabled={!canPreviousPage}
                                >
                                    {"<"}
                                </button>{" "}
                                <button
                                    className="badge bg-primary p-2 mr-2"
                                    onClick={() => nextPage()}
                                    disabled={!canNextPage}
                                >
                                    {">"}
                                </button>{" "}
                                <button
                                    className="badge bg-primary p-2 mr-2"
                                    onClick={() => gotoPage(pageCount - 1)}
                                    disabled={!canNextPage}
                                >
                                    {">>"}
                                </button>{" "}
                                <span>
                                    Page{" "}
                                    <strong>
                                        {pageIndex + 1} of {pageOptions.length}
                                    </strong>{" "}
                                </span>
                                <span>
                                    | Go to page:{" "}
                                    <input
                                        type="number"
                                        defaultValue={pageIndex + 1}
                                        onChange={(e) => {
                                            const page = e.target.value
                                                ? Number(e.target.value) - 1
                                                : 0;
                                            gotoPage(page);
                                        }}
                                        style={{ width: "100px" }}
                                    />
                                </span>{" "}
                                <select
                                    value={pageSize}
                                    onChange={(e) => {
                                        setPageSize(Number(e.target.value));
                                    }}
                                >
                                    {[10, 20, 30, 40, 50].map((pageSize) => (
                                        <option key={pageSize} value={pageSize}>
                                            Show {pageSize}
                                        </option>
                                    ))}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
