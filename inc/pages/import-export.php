<div class="qWrap">
    <br/><h2>Exam Matrix Import Export System</h2><br/>
    <!-- Import Box -->
    <div id="exImportBox" class="postbox ">
        <h3 class="hndle"><span>Import System</span></h3>
        <div class="inside">
                <div class="main">
                    <ul>
                        <li><p> Only CSV ( Comma Delimited ) file will be imported </p></li>
                        <li>
                            <form method="post">
                                <input type="file" name="exCsvToImport" />
                                <input type="Submit" value="Import" class="button" name="exImportCsv" />
                            </form>
                        </li>
                        <li><p>Please download a example csv file for verifying format of your csv file</p></li>
                    </ul>
                </div>
        </div>
    </div>
    <!-- Export Box -->
    <div id="exExportBox" class="postbox ">
    <h3 class="hndle"><span>Export System</span></h3>
        <div class="inside">
                <div class="main">
                    <ul>
                        <li><p> Output format will be CSV ( Comma Delimited ) </p></li>
                        <li>
                            <form method="post">
                                <select name="exCsvToExport">
                                    <option value="NONE">Select</option>
                                    <option value="QUES">Questions</option>
                                    <option value="RESULT">Results</option>
                                </select>
                                <input type="Submit" value="Export" class="button" name="exExportCsv" />
                            </form>
                        </li>
                        <li><p>Please download a example csv file for verifying format of your csv file</p></li>
                    </ul>
                </div>
        </div>
    </div>
</div>