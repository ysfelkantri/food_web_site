  <!DOCTYPE html>
  <html>

  <head>
      <title>Send mail from PHP using SMTP</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>

  <body>
      <div class="container">
          <h1 class="text-center">Sending Emails in PHP from localhost with SMTP</h1>
          <h2 class="text-center">Part 3: Using PHPMailer with attachments</h2>
          <hr>

          <div class="row">
              <div class="col-md-9 col-md-offset-2">
                  <form role="form" method="post" enctype="multipart/form-data">
                      <div class="row">
                          <div class="col-sm-9 form-group">
                              <label for="email">To Email:</label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" maxlength="50">
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-9 form-group">
                              <label for="subject">Subject:</label>
                              <input type="text" class="form-control" id="subject" name="subject" value="Test Mail with attachments" maxlength="50">
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-9 form-group">
                              <label for="name">Message:</label>
                              <textarea class="form-control" type="textarea" id="message" name="message" placeholder="Your Message Here" maxlength="6000" rows="4">Test mail using PHPMailer</textarea>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-9 form-group">
                              <label for="name">File:</label>
                              <input name="file[]" multiple="multiple" class="form-control" type="file" id="file">
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-9 form-group">
                              <button type="submit" name="sendmail" class="btn btn-lg btn-success btn-block">Send</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
  </body>

  </html>