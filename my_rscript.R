library(RMySQL)
drv=dbDriver('MySQL')
smsDB <- dbConnect(MySQL(),user='root',password='nofear79',dbname='sms',host='127.0.0.1')
query <- "select * from hazard_reports"
dbSendQuery(smsDB,query)
dbClearResult(dbListResults(smsDB)[[1]])
data = dbReadTable(smsDB,"hazard_reports")
query <- "select * from risk_assesment"
dbSendQuery(smsDB,query)
dbClearResult(dbListResults(smsDB)[[1]])
data2 = dbReadTable(smsDB,"risk_assesment")
View(data)
table(data$aircraft_type)
plot(table(data$aircraft_reg))
pie(table(data$aircraft_type),col=rainbow(length(table(data$aircraft_type))))

jpeg('plot.jpg')
pie(table(data2$description),col=rainbow(length(table(data2$description))))
dev.off()
