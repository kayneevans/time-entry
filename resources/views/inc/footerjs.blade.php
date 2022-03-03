<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script type="text/javascript" language="javascript" src=" https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.print.min.js"></script>



<!-- <link rel="stylesheet" href="{{asset('js/app.js')}}"> -->

<!-- <script>
    function teamSideBHP() {
        document.getElementById("hiddenInputs-teamSide").innerHTML = "<input type='text' id='teamSide' name='teamSide' value='1' hidden />";
        document.getElementById("reqInputsCont").style.display = "block";
        document.getElementById("nav-oppPlay-tab").style.background = "grey";
        document.getElementById("primePlay-tab").style.background = "blue";
    }

    function teamSideOPP() {
        document.getElementById("hiddenInputs-teamSide").innerHTML = "<input type='text' id='teamSide' name='teamSide' value='2' hidden />";
        document.getElementById("reqInputsCont").style.display = "block";
        document.getElementById("primePlay-tab").style.background = "grey";
        document.getElementById("nav-oppPlay-tab").style.background = "blue";
    }
</script> -->


<script>
    function yesnoCheck(that) {
        if (that.value == "In") {
            document.getElementById("time").style.display = "block";
            document.getElementById("enterBtn").style.display = "block";
        } 
        if (that.value == "Out") {
            document.getElementById("time").style.display = "block";
            document.getElementById("time-out").style.display = "block";
            document.getElementById("enterBtn").style.display = "block";
        } else {
            document.getElementById("time-out").style.display = "none";
        }
        if (that.value == "Transfer") {
            document.getElementById("time").style.display = "block";
            document.getElementById("transfer").style.display = "block";
            document.getElementById("enterBtn").style.display = "block";
        } else {
            document.getElementById("transfer").style.display = "none";
        }
    }
</script>

<script> 
// This code empowers all input tags having a placeholder and data-slots attribute
document.addEventListener('DOMContentLoaded', () => {
    for (const el of document.querySelectorAll("[placeholder][data-slots]")) {
        const pattern = el.getAttribute("placeholder"),
            slots = new Set(el.dataset.slots || "_"),
            prev = (j => Array.from(pattern, (c,i) => slots.has(c)? j=i+1: j))(0),
            first = [...pattern].findIndex(c => slots.has(c)),
            accept = new RegExp(el.dataset.accept || "\\d", "g"),
            clean = input => {
                input = input.match(accept) || [];
                return Array.from(pattern, c =>
                    input[0] === c || slots.has(c) ? input.shift() || c : c
                );
            },
            format = () => {
                const [i, j] = [el.selectionStart, el.selectionEnd].map(i => {
                    i = clean(el.value.slice(0, i)).findIndex(c => slots.has(c));
                    return i<0? prev[prev.length-1]: back? prev[i-1] || first: i;
                });
                el.value = clean(el.value).join``;
                el.setSelectionRange(i, j);
                back = false;
            };
        let back = false;
        el.addEventListener("keydown", (e) => back = e.key === "Backspace");
        el.addEventListener("input", format);
        el.addEventListener("focus", format);
        el.addEventListener("blur", () => el.value === pattern && (el.value=""));
    }
});
</script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
        $('#datatable2').DataTable();
        $('#datatable3').DataTable();

        var table = $('#datatable-admin').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: [
                        'copy',
                        'excel',
                        {
                            extend: 'csvHtml5',
                            text: 'CSV',
                            exportOptions: {
                                modifier: {
                                    search: 'none'
                                },
                                columns: ':not(:last-child)',
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            title: 'Test Data export',
                            exportOptions: {
                                columns: ':not(:last-child)',
                            }
                        },
                        'print',
                    ]
                }
            ]
        });
      
    } );

</script>
