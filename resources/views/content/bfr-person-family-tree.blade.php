@extends('layouts.bfr-app')

@section('content')
    <style type="text/css">
        .linage {
            fill: none;
            stroke: #000;
        }

        .marriage {
            fill: none;
            stroke: black;
        }

        .marriageNode {
            background-color: black;
            border-radius: 50%;
        }

        .man,
        .woman {
            border-style: solid;
            border-width: 1px;
            box-sizing: border-box;
            border-radius: 10px;
            justify-items: center;
            display: flex;
            align-content: center;
            cursor: pointer;
        }

        .woman {
            background-color: rgb(254, 255, 195);
        }
        .woman:hover {
            background-color: rgb(253, 255, 160);
        }
        .woman:active {
            background-color: rgb(251, 253, 98);
        }

        .man {
            background-color: rgb(199, 219, 255);
        }
        .man:hover {
            background-color: rgb(173, 200, 252);
        }
        .man:active {
            background-color: rgb(135, 176, 252);
        }

        .man p,
        .woman p {
            padding: 10px;
            font-size: 0.75rem !important;
            line-height: 1rem;
            margin: auto;
            width: 100%;
        }

        svg {
            border-style: solid;
            border-width: 1px;
        }

    </style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Silsilah (Orang Tua, {{ $spouse->name }}, Saudara & Anak) &middot; {{ $person->name }}</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('person.show', ['id' => $person->id]) }}"
                                        class="btn btn-outline-white btn-sm mb-1 me-3">Kembali ke Detail Orang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div id="graph"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.min.js"></script>
    <script src="https://d3js.org/d3.v4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/d3-dtree@2.4.1/dist/dTree.min.js"
        integrity="sha256-ivCQ2yfEMvo8cMzc+bxrK4AIE6gX/JAyVp7dz3EZeN8=" crossorigin="anonymous"></script>

    <script>
        treeJson = d3.json("{{ route('person.family.tree.json', ['id' => $person->id]) }}", function(error, treeData) {
            dTree.init(treeData, {
                target: "#graph",
                debug: false,
                hideMarriageNodes: false,
                marriageNodeSize: 10,
                height: 500,
                width: 1200,
                callbacks: {
                    nodeClick: function(name, extra) {
                        if (extra && extra.tree_link) {
                            window.location.href = extra.tree_link
                        }
                    },
                    // nodeRightClick: function(name, extra) {
                    //     alert('Right-click: ' + name);
                    // },
                    // textRenderer: function(name, extra, textClass) {
                    //     if (extra && extra.nickname)
                    //         name = name + " (" + extra.nickname + ")";
                    //     return "<p align='center' class='" + textClass + "'>" + name + "</p>";
                    // },
                    // marriageClick: function(extra, id) {
                    //     alert('Clicked marriage node' + id);
                    // },
                    // marriageRightClick: function(extra, id) {
                    //     alert('Right-clicked marriage node' + id);
                    // },
                }
            });
        });
    </script>
@endsection
